<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.banners.';
    const PATH_UPLOAD = 'banners';

    public function index()
    {
        $data = Banner::query()->latest('id')->paginate(5);

        // Kiểm tra nếu không có dữ liệu
        if ($data->isEmpty()) {
            return view(self::PATH_VIEW . 'index', compact('data'))
                ->with('status', 'Không có dữ liệu nào.');
        }

        return view(self::PATH_VIEW . 'index', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }

        Banner::create($data);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Banner::query()->findOrFail($id);

        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Banner::query()->findOrFail($id);

        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = Banner::findOrFail($id);
        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($model->image && Storage::exists($model->image)) {
                Storage::delete($model->image);
            }
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }

        $model->update($data);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Cập nhật thành công');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Banner::query()->findOrFail($id);

        $model->delete();

        if ($model->image && Storage::exists($model->image)) {
            Storage::delete($model->image);
        }

        return back();
    }
}
