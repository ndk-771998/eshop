<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Components\Recusive;
use App\Http\Requests\AddPostRequest;
use App\Models\Category;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostAdminController extends Controller
{
    protected $post, $category;

    use StorageImageTrait;

    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    public function index()
    {
        $posts = $this->post->paginate(5);
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $categoryList = $this->getCategory($parent_id = ''); 

        return view('admin.post.create', compact('categoryList'));
    }

    public function getCategory($parent_id)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $categoryList = $recusive->categoryRecusive($parent_id);

        return $categoryList;
    }

    public function store(AddPostRequest $request)
    {
        $dataPostCreate = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'views' => 1 
        ];

        $dataUploadFeatureImage = $this->storageImageUpload($request, 'feature_image_path', 'post');

        if (!empty($dataUploadFeatureImage)) {
            $dataPostCreate['image_name'] = $dataUploadFeatureImage['file_name'];
            $dataPostCreate['image_path'] = $dataUploadFeatureImage['file_path'];
        }

        $post = $this->post->create($dataPostCreate);

        return redirect()->route('post.index');
    }
}
