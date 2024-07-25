<?php
namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        $query = $this->applyFilters($request, $query);
        $products = $query->with(['sales' => function ($query) {
            $query->where('status', true)
                  ->where(function($query) {
                      $query->where('start_date', '<=', now())
                            ->orWhereNull('start_date');
                  })
                  ->where(function($query) {
                      $query->where('end_date', '>=', now())
                            ->orWhereNull('end_date');
                  });
        }])->get();
        $categories = Category::all();
        $brands = Brand::all();
        $posts = Post::all();

        return view('client.home', compact('products', 'categories', 'brands', 'posts'));
    }

    public function shop(Request $request)
    {
        $query = Product::query();
        $query = $this->applyFilters($request, $query);

        $products = $query->paginate(9);
        $categories = Category::all();
        $brands = Brand::all();

        if ($request->ajax()) {
            return view('partials.product_list', compact('products'))->render();
        }

        return view('client.shop', compact('products', 'categories', 'brands'));
    }

    private function applyFilters(Request $request, $query)
    {
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [(float)$request->min_price, (float)$request->max_price]);
        }

        if ($request->filled('category_filter')) {
            $query->whereIn('category_id', $request->category_filter);
        }

        if ($request->filled('brand_filter')) {
            $query->whereIn('brand_id', $request->brand_filter);
        }

        if ($request->filled('sort_by')) {
            switch ($request->sort_by) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'rating_asc':
                    $query->orderBy('rating', 'asc');
                    break;
                case 'rating_desc':
                    $query->orderBy('rating', 'desc');
                    break;
                default:
                    break;
            }
        }

        return $query;
    }
}
