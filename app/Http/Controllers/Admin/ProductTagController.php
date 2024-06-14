<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductTagController extends Controller
{

    const PATH_VIEW = 'admin.product_tag.';
    const PATH_UPLOAD = 'tag.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prd_tag=ProductTag::query()->latest('id')->paginate(5);
        return view(self::PATH_VIEW . 'index', compact('prd_tag'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tag = Tag::query()->pluck('name','id')->all();
        $product = Product::query()->pluck('name','id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact(['tag','product']));
    }

    /**
     * Store a newly created resource in storage.
     */

    // public function store(Request $request)
    // {
    //     // $request->validate([
    //     //     'product_id' => 'required|exists:products,id',
    //     //     'tag_id' => 'required|exists:tags,id',
    //     // ]);
    //     ProductTag::create($request->all());
    //     return redirect()->route('admin.product_tag.index');
    // }

    public function store(Request $request)
{
    // Bật lại xác minh dữ liệu để đảm bảo rằng các trường cần thiết được cung cấp và hợp lệ
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'tag_id' => 'required|exists:tags,id',
    ]);

    // Tạo bản ghi mới với đầy đủ các trường dữ liệu cần thiết
    ProductTag::create([
        'product_id' => $request->input('product_id'),
        'tag_id' => $request->input('tag_id'),
        'updated_at' => now(),
        'created_at' => now(),
    ]);

    return redirect()->route('admin.product_tag.index');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = ProductTag::findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model=ProductTag::query()->findOrFail($id);

        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'tag_id' => 'required|exists:tags,id',
        ]);

        $productTag = ProductTag::find($id);
        $productTag->update($request->all());
        return redirect()->route('product_tags.index')->with('success', 'Product Tag updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productTag = ProductTag::find($id);
        $productTag->delete();
        return redirect()->route('product_tags.index')->with('success', 'Product Tag deleted successfully.');
    }
}
