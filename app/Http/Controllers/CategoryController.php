<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\Recusive;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use DeleteModelTrait, StorageImageTrait;

    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function index()
    {
        $categories = $this->category->latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $categoryList = $this->getCategory($parent_id = '');

        return view('admin.category.create', compact('categoryList'));
    }

    public function store(Request $request)
    {
        $data = [
            'category_name' => $request->category_name,
            'parent_id' => $request->parent_id,
            'category_desc' => $request->category_desc,
            'slug' => Str::slug($request->category_name)
        ];

        $dataImageCategory = $this->storageImageUpload($request, 'image_path', 'category');

        if (!empty($dataImageCategory)) {
            $data['image_name'] = $dataImageCategory['file_name'];
            $data['image_path'] = $dataImageCategory['file_path'];
        }

        $this->category->create($data);

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = $this->category->find($id);
        $categoryList = $this->getCategory($category->parent_id);
        return view('admin.category.edit', compact('category', 'categoryList'));
    }

    public function delete($id)
    {

        return $this->deleteModelTrait($id, $this->category);
    }

    public function update($id, Request $request)
    {
        $data = [
            'category_name' => $request->category_name,
            'parent_id' => $request->parent_id,
            'category_desc' => $request->category_desc,
            'slug' => Str::slug($request->category_name)
        ];

        $dataImageCategory = $this->storageImageUpload($request, 'image_path', 'category');

        if (!empty($dataImageCategory)) {
            $data['image_name'] = $dataImageCategory['file_name'];
            $data['image_path'] = $dataImageCategory['file_path'];
        }

        $this->category->find($id)->update($data);

        return redirect()->route('categories.index');
    }

    public function getCategory($parent_id)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $categoryList = $recusive->categoryRecusive($parent_id);

        return $categoryList;
    }
}
