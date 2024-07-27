<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Method to list all posts
    // public function index()
    // {
    //     $posts = Post::all();
    //     return view('client.posts.index', compact('posts'));
    // }

    // Method to show a single post
    public function show($id)
    {
        try {
            $post = Post::findOrFail($id);
            return view('client.post', compact('post'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('client.posts.index')->with('error', 'Post not found');
        }
    }


    public function new(Request $request)
    {

        $posts = Post::all();

        return view('client.new', compact('posts'));
    }
}
