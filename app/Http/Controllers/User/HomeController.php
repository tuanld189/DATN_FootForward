<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index()
    {
        $products = Product::all(); // Lấy tất cả sản phẩm
        $categories = Category::all(); // Lấy tất cả danh mục
        $brands = Brand::all(); // Lấy tất cả thương hiệu
        return view('client.home', compact('products', 'categories', 'brands'));

    }
}

