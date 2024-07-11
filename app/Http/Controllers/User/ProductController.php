<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with([
            'galleries',
            'variants' => function ($query) {
                $query->whereNotNull('image');
            },
            'variants.color',
            'variants.size',
            'comments.user' // Eager load comments and associated users
        ])->findOrFail($id);

        $categories = Category::all();
        $brands = Brand::all();

        return view('client.show', compact('product', 'categories', 'brands'));
    }

    public function storeForProduct(Request $request, $productId)
{
    $validatedData = $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    $comment = new Comment();
    $comment->user_id = Auth::id();
    $comment->content = $validatedData['content'];
    $comment->created_by = Auth::id();
    $comment->updated_by = Auth::id();
    $comment->product_id = $productId;
    $comment->save();

    return redirect()->back()->with('success', 'Comment added successfully');
}

public function deleteComment($commentId)
{
    $comment = Comment::findOrFail($commentId);

    if ($comment->user_id != Auth::id()) {
        return redirect()->back()->with('error', 'You can only delete your own comments.');
    }

    $comment->delete();
    return redirect()->back()->with('success', 'Comment deleted successfully.');
}


    public function getQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $colorId = $request->input('product_color_id');
        $sizeId = $request->input('product_size_id');

        // Query để lấy số lượng có sẵn của biến thể sản phẩm
        $productVariant = ProductVariant::where('product_id', $productId)
            ->where('product_color_id', $colorId)
            ->where('product_size_id', $sizeId)
            ->first();

        if ($productVariant) {
            $quantity = $productVariant->quantity;
        } else {
            $quantity = 0; // Nếu không tìm thấy thì số lượng là 0
        }

        return response()->json(['quantity' => $quantity]);
    }
    public function postComment(Request $request, $productId)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->content = $validatedData['content'];
        $comment->created_by = Auth::id();
        $comment->updated_by = Auth::id();
        $comment->save();

        // Liên kết comment với sản phẩm
        $product = Product::findOrFail($productId);
        $product->comments()->attach($comment->id);

        return redirect()->back()->with('status', 'Comment posted successfully');
    }

}
