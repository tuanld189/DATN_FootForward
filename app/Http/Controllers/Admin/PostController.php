<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    const PATH_VIEW = 'admin.post.';
    const PATH_UPLOAD = 'post';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::query()->latest('id')->paginate(5);
        $status = $posts->isEmpty() ? 'Không có dữ liệu nào.' : null;

        return view(self::PATH_VIEW . 'index', compact('posts'))
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
        // Xác thực dữ liệu yêu cầu
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|in:published,draft', // Ví dụ trạng thái
            'content' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        // Xử lý hình ảnh
        if ($request->hasFile('image')) {
            $validatedData['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }

        // Gán người tạo và người cập nhật nếu cần
        // $validatedData['created_by'] = Auth::id();
        // $validatedData['updated_by'] = Auth::id();

        // Tạo bài viết
        Post::create($validatedData);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Post::findOrFail($id);
        return view(self::PATH_VIEW . 'show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Post::findOrFail($id);
        return view(self::PATH_VIEW . 'edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = Post::findOrFail($id);
        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($model->image && Storage::exists($model->image)) {
                Storage::delete($model->image);
            }
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }
        // $data['updated_by'] = Auth::id();
        $model->update($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(string $id)
    {
        $model = Post::query()->findOrFail($id);

        $model->delete();

        if ($model->image && Storage::exists($model->image)) {
            Storage::delete($model->image);
        }

        return back();
    }
}
