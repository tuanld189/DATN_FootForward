<?php
namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        $products = $query->with('sales')->get();
        $categories = Category::all();
        $brands = Brand::all();
        $posts = Post::all();

        return view('client.home', compact('products', 'categories', 'brands', 'posts'));
    }

    public function shop(Request $request)
    {
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $categories = Category::all();
        $brands = Brand::all();

        $sort = $request->get('sort', 'newest');
        $query = Product::query();

        // Handle search
        if ($request->has('search') && !empty($request->input('search'))) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        // Handle sorting
        switch ($sort) {
            case 'price_high_low':
                $query->orderBy('price', 'desc');
                break;
            case 'price_low_high':
                $query->orderBy('price', 'asc');
                break;
            case 'best_selling':
                // Add logic for best selling if applicable
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Handle category filter
        if ($request->has('category_filter')) {
            $query->whereIn('category_id', $request->category_filter);
        }

        // Handle brand filter
        if ($request->has('brand_filter') && !empty($request->input('brand_filter'))) {
            $query->whereIn('brand_id', $request->input('brand_filter'));
        }

        // Handle size filter
        if ($request->has('size_filter')) {
            $query->whereHas('sizes', function ($q) use ($request) {
                $q->whereIn('id', $request->input('size_filter'));
            });
        }

        // Handle color filter
        if ($request->has('color_filter')) {
            $query->whereHas('colors', function ($q) use ($request) {
                $q->whereIn('id', $request->input('color_filter'));
            });
        }

        // Handle price filter
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }

        try {
            $products = $query->with('sales')->paginate(9);
        } catch (\Exception $e) {
            \Log::error('Error fetching products', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Unable to load products'], 500);
        }

        if ($request->ajax()) {
            return response()->json([
                'product_list' => view('client.product-list', compact('products'))->render(),
                // 'pagination' => view('pagination', compact('products'))->render(),
            ]);
        }

        return view('client.shop', compact('products', 'categories', 'brands', 'sizes', 'colors'));
    }
}
