<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    const PATH_VIEW='admin.products.';
    const PATH_UPLOAD='products';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Product::query()->latest('id')->paginate(5);
        return view(self::PATH_VIEW . __FUNCTION__,compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('name','id')->all();
        $brands = Brand::query()->pluck('name','id')->all();
        $colors = ProductColor::query()->pluck('name','id')->all();
        $sizes = ProductSize::query()->pluck('name','id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact(['categories','brands','colors','sizes']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('img_thumbnail');
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
        $data['is_new'] = $request->has('is_new') ? 1 : 0;
        $data['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
        if($request->hasFile('img_thumbnail')) { // Kiểm tra xem đã có hình ảnh được gửi đi hay chưa
            $data['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('img_thumbnail'));
        }
        // dd($data);
        Product::query()->create($data);

        // Validate dữ liệu trước khi lưu
        $validatedData = $request->validate([
            'category_id' => 'required',
            'brand_id' => 'required',
            'sku' => 'required|unique:products,sku',
            'slug' => 'required|unique:products,slug',
            'name' => 'required',
            'content' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'status' => 'required|boolean',
            'is_hot_deal' => 'required|boolean',
            'is_new' => 'required|boolean',
            'is_show_home' => 'required|boolean',
            'img_thumbnail' => 'required|image'
        ]);

        // Lưu sản phẩm
        $product = new Product($validatedData);
        $product->save();

        // Lấy ID của sản phẩm vừa được lưu
        $productId = $product->id;

        // Chuyển hướng đến trang quản lý variants của sản phẩm này
        return redirect()->route('admin.products.index', compact('product'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model=Product::query()->findOrFail($id);

        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model=Product::query()->findOrFail($id);
        $categories = Category::query()->pluck('name','id')->all();
        $brands = Brand::query()->pluck('name','id')->all();
        $colors = ProductColor::query()->pluck('name','id')->all();
        $sizes = ProductSize::query()->pluck('name','id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact(['model','categories','brands','colors','sizes']));
        // return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model=Product::query()->findOrFail($id);
        $data=$request->except('img_thumbnail');
        if($request->hasFile('img_thumbnail')) { // Kiểm tra xem đã có hình ảnh được gửi đi hay chưa
            $data['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('img_thumbnail'));
        }

        $current_image=$model->img_thumbnail;

        $model->update($data);

        if($current_image&& Storage::exists($current_image)){
            Storage::delete($current_image);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $model = Product::query()->findOrFail($id);

    // Xóa tất cả các biến thể của sản phẩm
    $model->variants()->delete();

    // Xóa tất cả các ảnh liên quan đến sản phẩm
    $model->galleries()->delete();

    if ($model->image && Storage::exists($model->image)) {
        Storage::delete($model->image);
    }

    $model->delete();

    return back();
}
}
