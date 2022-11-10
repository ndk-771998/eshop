<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class WebController extends Controller
{
    protected $slider, $category;

    public function __construct(Slider $slider, Category $category, Product $product)
    {
        $this->slider = $slider;
        $this->category = $category;
        $this->product = $product;
    }

    public function homePage()
    {
        $sliders = $this->slider->all();
        $categories = $this->category->where('parent_id', '<>', 0)->get();
        $products = $this->product->all();

        return view('web.pages.home', compact('sliders', 'categories', 'products'));
    }
}
