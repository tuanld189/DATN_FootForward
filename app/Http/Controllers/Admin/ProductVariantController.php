<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductVariantController extends Controller
{
    const PATH_VIEW='admin.variants.';
    const PATH_UPLOAD='variants';

    /**
     * Display a listing of the resource.
     */
    public function index($productId)
{
    $product = Product::findOrFail($productId);
    $variants = ProductVariant::where('product_id', $productId)->with(['color', 'size'])->paginate(5);
    // $variants=Product::query()->latest('id');
    //  Lọc các biến thể có thuộc tính 'color' và 'size' không null
    // $filteredVariants = $variants->filter(function ($variant) {
    //     return $variant->color && $variant->size;
    // });
    return view(self::PATH_VIEW . 'index', compact('product', 'variants'));
}
    public function show($productId, $id)
    {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($id);

        return view(self::PATH_VIEW . 'show', compact('product', 'variant'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        $colors = ProductColor::query()->pluck('name','id')->all();
        $sizes = ProductSize::query()->pluck('name','id')->all();
        return view(self::PATH_VIEW . 'create', compact('product', 'colors', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $data = $request->except('image');
        $data['product_id'] = $productId;

        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }

        ProductVariant::create($data);
        return redirect()->route('admin.products.variants.index', $productId);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($productId, $id)
    {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($id);
        $colors = ProductColor::pluck('name', 'id');
        $sizes = ProductSize::pluck('name', 'id');
        return view(self::PATH_VIEW . 'edit', compact('product', 'variant', 'colors', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $productId, $id)
    {
        $variant = ProductVariant::findOrFail($id);
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            if ($variant->image && Storage::exists($variant->image)) {
                Storage::delete($variant->image);
            }
        }

        $variant->update($data);
        return redirect()->route('admin.products.variants.index', $productId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productId, $id)
    {
        $variant = ProductVariant::findOrFail($id);
        if ($variant->image && Storage::exists($variant->image)) {
            Storage::delete($variant->image);
        }
        $variant->delete();
        return redirect()->route('admin.products.variants.index', $productId);
    }
}
