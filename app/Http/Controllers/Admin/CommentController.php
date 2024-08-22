<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     // $comments = Comment::with('user', 'post', 'product')->get();
    //     $comments = Comment::with('user', 'post', 'product')->paginate(10);
    //     $status = $comments->isEmpty() ? 'Không có bình luận nào.' : null;
    //     // return view(self::PATH_VIEW . 'index', compact('data'));
    //     // return view(self::PATH_VIEW . 'index', compact('data'))
    //     //     ->with('status', $status);
    //     return view('admin.comments.index', compact('status'));
    // }
    public function index()
    {
        // Lấy dữ liệu bình luận với thông tin người dùng, bài viết và sản phẩm kèm theo phân trang
        $comments = Comment::with('user', 'post', 'product')->paginate(10);

        // Kiểm tra nếu không có dữ liệu
        $status = $comments->isEmpty() ? 'Không có bình luận nào.' : null;

        // Trả về view với dữ liệu bình luận và trạng thái
        return view('admin.comments.index', compact('comments', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $posts = Post::all();
        return view('admin.comments.create', compact('users', 'posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'product_id' => 'required|exists:products,id', // Corrected to 'products' table
            'content' => 'required|string',
        ]);

        if ($validatedData) {
            $validatedData['created_by'] = Auth::id();
            $validatedData['updated_by'] = Auth::id();

            $comment = Comment::create($validatedData);

            if ($comment) {
                return redirect()->route('admin.comments.index')->with('status', 'Comment Created Successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to create comment');
            }
        } else {
            // Handle validation errors
            return redirect()->back()->withErrors($request->errors())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $users = User::all();
        $posts = Post::all();
        return view('admin.comments.edit', compact('comment', 'users', 'posts'));
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return view('admin.comments.show', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string',
        ]);

        $comment = Comment::findOrFail($id);
        $validatedData['updated_by'] = Auth::id();

        $comment->update($validatedData);
        return redirect()->route('admin.comments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->route('admin.comments.index');
    }
}
