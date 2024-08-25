<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductGallery;
use App\Models\Tag;
use App\Models\Category;
use App\Models\ProductSale;

use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
// use Excel;
// use App\Imports\ProductsImport;
// use App\Exports\ProductsExport;
// use App\Imports\ProductImport;
// use Maatwebsite\Excel\Excel as ExcelExcel;
// // use Maatwebsite\Excel\Excel as ExcelExcel;
// use Maatwebsite\Excel\Facades\Excel;

use App\Imports\ProductsImport;
use App\Exports\ProductsExport;
// use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


// class ProductController extends Controller
class ProductController extends Controller
{

    const PATH_VIEW = 'admin.products.';
    const PATH_UPLOAD = 'products';

    public function index(Request $request)
    {
        $categories = Category::pluck('name', 'id')->all();
        $brands = Brand::pluck('name', 'id')->all();

        $query = Product::query();

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('brand_id') && $request->brand_id != '') {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $perPage = 6;
        $data = $query->with(['category', 'tags', 'brand'])->latest('id')->paginate($perPage);

        return view(self::PATH_VIEW . 'index', compact('data', 'categories', 'brands'));
    }

    public function importProducts(Request $request)
    {
        $import = new ProductsImport();
        Excel::import($import, $request->file('file'));

        return back()->with('success', 'Products imported successfully!');
    }




    // public function export()
    // {
    //     return Excel::download(new ProductsExport, 'products.xlsx');
    // }

    // end import & export

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('name', 'id')->all();
        $brands = Brand::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact(['categories', 'brands', 'colors', 'sizes', 'tags']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataProduct = $request->except(['product_variants', 'tags', 'product_galleries']);

        $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
        $dataProduct['is_hot_deal'] = isset($dataProduct['is_hot_deal']) ? 1 : 0;
        $dataProduct['is_new'] = isset($dataProduct['is_new']) ? 1 : 0;
        $dataProduct['is_show_home'] = isset($dataProduct['is_show_home']) ? 1 : 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];

        if ($request->has('img_thumbnail')) {
            $dataProduct['img_thumbnail'] = $request->input('img_thumbnail');
        }

        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];
        foreach ($dataProductVariantsTmp as $key => $item) {
            $tmp = explode('-', $key);
            $dataProductVariants[] = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $item['quantity'],
                'image' => $item['image'] ?? null,
            ];
        }

        $dataProductTags = $request->tags;
        $dataProductGalleries = $request->product_galleries ?: [];

        try {
            DB::beginTransaction();

            /** @var Product $product */
            $product = Product::query()->create($dataProduct);
            foreach ($dataProductVariants as $dataProductVariant) {
                $dataProductVariant['product_id'] = $product->id;
                $dataProductVariant['image'] = $dataProductVariant['image'] ?? null;
                ProductVariant::query()->create($dataProductVariant);
            }
            $product->tags()->sync($dataProductTags);
            foreach ($dataProductGalleries as $image) {
                if ($image) {
                    ProductGallery::query()->create([
                        'product_id' => $product->id,
                        'image' => $image
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.products.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $model = Product::with(['category', 'brand', 'tags', 'galleries', 'variants', 'sales'])->findOrFail($id);
        $sale = ProductSale::where('status', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->whereHas('products', function ($query) use ($id) {
                $query->where('product_id', $id);
            })
            ->first();

        $salePrice = $sale ? $sale->sale_price : null;
        return view(self::PATH_VIEW . __FUNCTION__, compact('model', 'salePrice'));
    }

    public function edit($id)
    {
        $product = Product::with(['category', 'brand', 'tags', 'galleries', 'variants'])->findOrFail($id);
        $categories = Category::query()->pluck('name', 'id')->all();
        $brands = Brand::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact(['product', 'categories', 'brands', 'colors', 'sizes', 'tags']));
    }
    public function update(Request $request, $id)
    {
        $dataProduct = $request->except(['product_variants', 'tags', 'product_galleries']);
        $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
        $dataProduct['is_hot_deal'] = isset($dataProduct['is_hot_deal']) ? 1 : 0;
        $dataProduct['is_new'] = isset($dataProduct['is_new']) ? 1 : 0;
        $dataProduct['is_show_home'] = isset($dataProduct['is_show_home']) ? 1 : 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];

        $product = Product::findOrFail($id);

        if ($request->has('img_thumbnail')) {
            if ($product->img_thumbnail) {
            }
            $dataProduct['img_thumbnail'] = $request->input('img_thumbnail');
        } else {
            $dataProduct['img_thumbnail'] = $product->img_thumbnail;
        }

        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];
        foreach ($dataProductVariantsTmp as $key => $item) {
            $tmp = explode('-', $key);
            $variantData = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $item['quantity'],
                'image' => $item['image'] ?? null,
            ];

            $existingVariant = $product->variants()->where('product_size_id', $tmp[0])
            ->where('product_color_id', $tmp[1])->first();

            if ($existingVariant) {
                if (isset($item['image'])) {
                    $variantData['image'] = $item['image'];
                } else {
                    $variantData['image'] = $existingVariant->image;
                }
            } elseif (isset($item['image'])) {
                $variantData['image'] = $item['image'];
            }

            $dataProductVariants[] = $variantData;
        }

        $dataProductTags = $request->tags;
        $dataProductGalleries = $request->product_galleries ?: [];

        try {
            DB::beginTransaction();

            $product->update($dataProduct);

            foreach ($dataProductVariants as $dataProductVariant) {
                $dataProductVariant['product_id'] = $product->id;
                $existingVariant = ProductVariant::where('product_id', $product->id)
                    ->where('product_size_id', $dataProductVariant['product_size_id'])
                    ->where('product_color_id', $dataProductVariant['product_color_id'])
                    ->first();

                if ($existingVariant) {
                    $existingVariant->update($dataProductVariant);
                } else {
                    ProductVariant::create($dataProductVariant);
                }
            }

            $product->tags()->sync($dataProductTags);

            ProductGallery::where('product_id', $product->id)->delete();
            foreach ($dataProductGalleries as $image) {
                if ($image) {
                    ProductGallery::create([
                        'product_id' => $product->id,
                        'image' => $image
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.products.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return back();
        }
    }
    public function destroy(Product $product)
    {
        try {
            DB::transaction(function () use ($product) {
                $product->tags()->sync([]);
                $product->galleries()->delete();
                $product->variants()->delete();
                $product->delete();
            }, 3);
            return back()->with('success', 'Product deleted successfully.');
        } catch (\Exception $exception) {
            return back()->with('error', 'An error occurred while deleting the product.');
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('q');
        $tags = Tag::where('name', 'LIKE', "%{$search}%")->get();
        return response()->json($tags);
    }


    // public function deleteGallery(Request $request)
    // {
    //     $galleryId = $request->input('gallery_id');
    //     $imageUrl = $request->input('image_url');

    //     try {
    //         $gallery = ProductGallery::findOrFail($galleryId);
    //         $gallery->delete();

    //         Storage::delete($imageUrl);

    //         return response()->json(['success' => true]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false]);
    //     }
    // }

    public function deleteGallery(Product $product, $galleryId)
    {
        $gallery = $product->galleries()->find($galleryId);

        if ($gallery) {
            $gallery->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function searchProducts(Request $request)
    {
        $search = $request->input('term');

        $products = Product::whereDoesntHave('sales')
            ->where('name', 'LIKE', "%{$search}%")
            ->get(['id', 'name']);

        return response()->json($products);
    }
}
