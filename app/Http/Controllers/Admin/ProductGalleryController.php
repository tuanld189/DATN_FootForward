<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductGallery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductGalleryController extends Controller
{
    const PATH_VIEW = 'admin.galleries.';
    const PATH_UPLOAD = 'galleries';

    public function index($productId)
    {
        $product = Product::findOrFail($productId);
        $data = $product->galleries()->latest('id')->paginate(5);
        return view(self::PATH_VIEW . 'index', compact('data', 'product'));
    }

    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        return view(self::PATH_VIEW . 'create', compact('product'));
    }

    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $data = $request->validate([
            'images.*' => 'required|image'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = Storage::put(self::PATH_UPLOAD, $image);
                $product->galleries()->create(['image' => $imagePath]);
            }
        }

        return redirect()->route('admin.products.galleries.index', ['productId' => $productId]);
    }

    public function show($productId, $id)
    {
        $product = Product::findOrFail($productId);
        $model = ProductGallery::findOrFail($id);
        return view(self::PATH_VIEW . 'show', compact('model', 'product'));
    }

    public function edit($productId, $id)
    {
        $product = Product::findOrFail($productId);
        $model = ProductGallery::findOrFail($id);
        return view(self::PATH_VIEW . 'edit', compact('model', 'product'));
    }

    public function update(Request $request, $productId, $id)
    {
        $model = ProductGallery::findOrFail($id);
        $data = $request->validate([
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            if ($model->image && Storage::exists($model->image)) {
                Storage::delete($model->image);
            }
        }

        $model->update($data);
        return redirect()->route('admin.products.galleries.index', ['productId' => $productId]);
    }

    public function destroy($productId, $id)
    {
        $model = ProductGallery::findOrFail($id);
        if ($model->image && Storage::exists($model->image)) {
            Storage::delete($model->image);
        }
        $model->delete();
        return back();
    }
}
