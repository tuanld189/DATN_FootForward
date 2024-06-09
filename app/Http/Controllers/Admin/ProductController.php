<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
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
        return view(self::PATH_VIEW . __FUNCTION__, compact(['categories','brands']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('image');
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
        $data['is_new'] = $request->has('is_new') ? 1 : 0;
        $data['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
        if($request->except('image')){
            $data['image']=Storage::put(self::PATH_UPLOAD,$request->file('image'));
        }
        Product::query()->create($data);

        return redirect()->route('admin.products.index');
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

        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model=Product::query()->findOrFail($id);
        $data=$request->except('image');
        if($request->except('image')){
            $data['image']=Storage::put(self::PATH_UPLOAD,$request->file('image'));
        }

        $current_image=$model->image;

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
        $model=Product::query()->findOrFail($id);

        $model->delete();

        if($model->image && Storage::exists($model->image)){
            Storage::delete($model->image);
        }

        return back();
    }
    // public function getProducts()
    // {
    //     $products = Product::all();

    //     return response()->json($products);
    // }
}
