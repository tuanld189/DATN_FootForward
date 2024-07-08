<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index()
    {
        $products = Product::with('sales')->get();
        $categories = Category::all(); // Lấy tất cả danh mục
        $brands = Brand::all(); // Lấy tất cả thương hiệu
        $posts= Post::all();
        return view('client.home', compact('products', 'categories', 'brands', 'posts'));

    }
    public function shop()
    {
        $products = Product::with('sales')->get();
        $categories = Category::all(); // Lấy tất cả danh mục
        $brands = Brand::all(); // Lấy tất cả thương hiệu
        $posts= Post::all();

        return view('client.shop', compact('products', 'categories', 'brands', 'posts'));
    }
}

