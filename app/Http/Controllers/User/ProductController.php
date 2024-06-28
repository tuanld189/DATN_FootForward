<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSale;
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

        // Logic để lấy giá sale nếu có
        $salePrice = null;

        $today = now()->format('Y-m-d');
        $sale = ProductSale::where('product_id', $product->id)
                           ->where('status', true)
                           ->where('start_date', '<=', $today)
                           ->where('end_date', '>=', $today)
                           ->latest()
                           ->first();

        if ($sale) {
            $salePrice = $sale->sale_price;
        }

        return view('client.show', compact('product', 'categories', 'brands', 'salePrice'));
    }
    public function getQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $colorId = $request->input('product_color_id');
        $sizeId = $request->input('product_size_id');

        // Query để lấy số lượng có sẵn của biến thể sản phẩm
        $productVariant = ProductVariant::where('product_id', $productId)
            ->where('product_color_id', $colorId)
            ->where('product_size_id', $sizeId)
            ->first();

        if ($productVariant) {
            $quantity = $productVariant->quantity;
        } else {
            $quantity = 0; // Nếu không tìm thấy thì số lượng là 0
        }

        return response()->json(['quantity' => $quantity]);
    }

}
