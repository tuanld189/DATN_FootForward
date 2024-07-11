<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    const PATH_VIEW = 'admin.brands.';
    const PATH_UPLOAD = 'brands';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Brand::query()->latest('id')->paginate(5);
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
        $data['is_active'] ??= 0;

        if ($request->has('image')) {
            $data['image'] = $request->input('image');
        }

        Brand::query()->create($data);

        return redirect()->route('admin.brands.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Brand::query()->findOrFail($id);
        return view(self::PATH_VIEW . 'show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Brand::query()->findOrFail($id);
        return view(self::PATH_VIEW . 'edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = Brand::query()->findOrFail($id);
        $data = $request->except('image');
        $data['is_active'] ??= 0;

        if ($request->has('image')) {
            $data['image'] = $request->input('image');
        }

        $model->update($data);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Brand::query()->findOrFail($id);

        $model->delete();

        return back();
    }
}
