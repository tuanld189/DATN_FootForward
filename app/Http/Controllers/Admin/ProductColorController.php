<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class ProductColorController extends Controller
{
    const PATH_VIEW = 'admin.colors.';
    const PATH_UPLOAD = 'colors';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=ProductColor::query()->latest('id')->paginate(7);
        return view(self::PATH_VIEW . 'index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }

        ProductColor::create($data);

        return redirect()->route('admin.colors.index')
                         ->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = ProductColor::findOrFail($id);
        return view(self::PATH_VIEW . 'show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = ProductColor::findOrFail($id);
        return view(self::PATH_VIEW . 'edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $model = ProductColor::findOrFail($id);
        $data = $request->except('image');


        if ($request->hasFile('image')) {
            if ($model->image && Storage::exists($model->image)) {
                Storage::delete($model->image);
            }
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }

        $model->update($data);

        return redirect()->route('admin.colors.index')
                         ->with('success', 'Cập nhật thành công');
    }




    public function destroy(string $id)
    {
        $model=ProductColor::query()->findOrFail($id);

        $model->delete();

        if($model->image && Storage::exists($model->image)){
            Storage::delete($model->image);
        }

        return back();
    }
}
