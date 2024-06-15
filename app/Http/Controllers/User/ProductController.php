<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with([
            'galleries',
            'variants' => function ($query) {
                $query->whereNotNull('image');
            },
            'variants.color',
            'variants.size'
        ])->findOrFail($id);

        $categories = Category::all();
        $brands = Brand::all();

        return view('users.show', compact('product', 'categories', 'brands'));
    }
    public function getProductQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $colorId = $request->input('product_color_id');
        $sizeId = $request->input('product_size_id');

        $variant = ProductVariant::where('product_id', $productId)
            ->where('product_color_id', $colorId)
            ->where('product_size_id', $sizeId)
            ->first();

        if ($variant) {
            return response()->json(['quantity' => $variant->quantity]);
        }

        return response()->json(['quantity' => 0]);
    }
}
