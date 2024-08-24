<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Post;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vourcher;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        $query = $this->applyFilters($request, $query);
        $products = $query->with([
            'sales' => function ($query) {
                $query->where('status', true)
                    ->where(function ($query) {
                        $query->where('start_date', '<=', now())
                            ->orWhereNull('start_date');
                    })
                    ->where(function ($query) {
                        $query->where('end_date', '>=', now())
                            ->orWhereNull('end_date');
                    });
            }
        ])->get();


        $productsOnSale = $products->filter(function ($product) {
            return $product->sales->isNotEmpty() && $product->sales->first()->pivot && $product->sales->first()->status;
        });

        $productsNoSale = $products->filter(function ($product) {
            return $product->sales->isEmpty() || !$product->sales->first()->pivot || !$product->sales->first()->status;
        });

        $categories = Category::all();
        $brands = Brand::all();
        $posts = Post::all();
        $banners = Banner::where('is_active', true)->get();
        if ($user = auth()->user()) {
            $notifications = $user->notifications;
            return view('client.home', compact('productsOnSale', 'productsNoSale', 'categories', 'brands', 'posts', 'banners', 'notifications'));

        } else {
            return view('client.home', compact('productsOnSale', 'productsNoSale', 'categories', 'brands', 'posts', 'banners'));

        }
    }

    public function info(Request $request)
    {
        return view('client.info');
    }

    private function applyFilters(Request $request, $query)
    {
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [(float) $request->min_price, (float) $request->max_price]);
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
        if ($request->has('size_filter') && !empty($request->input('size_filter'))) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->whereIn('product_size_id', $request->input('size_filter'));
            });
        }

        // Handle color filter
        if ($request->has('color_filter') && !empty($request->input('color_filter'))) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->whereIn('product_color_id', $request->input('color_filter'));
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
            $products = $query->with('sales', 'variants')->paginate(9);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to load products'], 500);
        }

        if ($request->ajax()) {
            return response()->json([
                'product_list' => view('client.product-list', compact('products'))->render(),
            ]);
        }
        return view('client.shop', compact('products', 'categories', 'brands', 'sizes', 'colors'));
    }
    public function checkout()
    {
        $vourchers = Vourcher::where('is_active', true)->get();

        return view('client.checkout', compact('vourchers'));
    }

}
