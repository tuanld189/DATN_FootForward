<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    const PATH_VIEW = 'admin.categories.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::query()->latest('id')->paginate(5);
        $status = $data->isEmpty() ? 'Không có dữ liệu nào.' : null;
        // return view(self::PATH_VIEW . 'index', compact('data'));
        return view(self::PATH_VIEW . 'index', compact('data'))
        ->with('status', $status);
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

        Category::create($data);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Category::findOrFail($id);
        return view(self::PATH_VIEW . 'show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Category::findOrFail($id);
        return view(self::PATH_VIEW . 'edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $model = Category::findOrFail($id);
        $data = $request->except('image');
        $data['is_active'] ??= 0;

        if ($request->has('image')) {
            $data['image'] = $request->input('image');
        }

        $model->update($data);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Category::query()->findOrFail($id);

        $model->delete();

        return back();
    }
}
