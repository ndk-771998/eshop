<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Http\Requests\ProductAddRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminProductController extends Controller
{
    use StorageImageTrait, DeleteModelTrait;

    private $category;
    private $product;
    private $tag;
    private $productImage;

    public function __construct(Category $category, Product $product, Tag $tag, ProductImage $productImage)
    {
        $this->category = $category;
        $this->product = $product;
        $this->tag = $tag;
        $this->productImage = $productImage;
    }

    public function index()
    {
        $products = $this->product->latest()->paginate(5);
        // dd($products[0]->category);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categoryList = $this->getCategory($parent_id = '');

        return view('admin.product.create', compact('categoryList'));
    }

    public function getCategory($parent_id)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $categoryList = $recusive->categoryRecusive($parent_id);

        return $categoryList;
    }

    public function store(ProductAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->content,
                'user_id' => auth()->user()->id,
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageImageUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->create($dataProductCreate);

            // Insert Image to Product Images

            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $file_item) {
                    $dataProductImageDetail = $this->storageImageUploadMultiple($file_item, 'product');
                    $product->productImages()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            // Insert Tags to Product Tags

            if (!empty($request->tags)) {
                foreach ($request->tags as $tag_item) {
                    // Insert tags
                    $tagInstance = $this->tag->firstOrCreate([
                        'name' => $tag_item,
                    ]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            $product->productTags()->attach($tagIds);
            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . ' ----- Line ' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        $categoryList = $this->getCategory($product->category_id);

        return view('admin.product.edit', compact('product', 'categoryList'));
    }

    public function update(Request $request,$id)
    {
        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->content,
                'user_id' => auth()->user()->id,
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageImageUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);

            // Insert Image to Product Images

            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image_path as $file_item) {
                    $dataProductImageDetail = $this->storageImageUploadMultiple($file_item, 'product');
                    $product->productImages()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            // Insert Tags to Product Tags

            if (!empty($request->tags)) {
                foreach ($request->tags as $tag_item) {
                    // Insert tags
                    $tagInstance = $this->tag->firstOrCreate([
                        'name' => $tag_item,
                    ]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            $product->productTags()->sync($tagIds);
            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . ' ----- Line ' . $exception->getLine());
        }
    }

    public function delete($id){
        return $this->deleteModelTrait($id, $this->product);
    }
}
