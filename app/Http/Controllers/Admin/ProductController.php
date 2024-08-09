<?php

namespace App\Http\Controllers\Admin;

use App\Excel\Imports\ProductsImport as ImportsProductsImport;
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

        // Set the number of items per page to 10
        $perPage = 6;
        $data = $query->with(['category', 'tags', 'brand'])->latest('id')->paginate($perPage);

        return view(self::PATH_VIEW . 'index', compact('data', 'categories', 'brands'));
    }


    // public function index(Request $request)
    // {
    //     $categories = Category::pluck('name', 'id')->all();
    //     $brands = Brand::pluck('name', 'id')->all();

    //     $query = Product::query();

    //     if ($request->has('category_id') && $request->category_id != '') {
    //         $query->where('category_id', $request->category_id);
    //     }

    //     if ($request->has('brand_id') && $request->brand_id != '') {
    //         $query->where('brand_id', $request->brand_id);
    //     }

    //     if ($request->has('name') && $request->name != '') {
    //         $query->where('name', 'like', '%' . $request->name . '%');
    //     }

    //     if ($request->has('date_from') && $request->date_from != '') {
    //         $query->whereDate('created_at', '>=', $request->date_from);
    //     }

    //     if ($request->has('date_to') && $request->date_to != '') {
    //         $query->whereDate('created_at', '<=', $request->date_to);
    //     }

    //     $data = $query->with(['category', 'tags', 'brand'])->latest('id')->get();

    //     return view(self::PATH_VIEW . 'index', compact('data', 'categories', 'brands'));
    // }



    // public function import(Request $request)
    // {
    //     $request->validate([
    //         'file_excel' => 'required|mimes:xlsx,csv',
    //     ]);

    //     // Perform the import
    //     Excel::import(new ProductsImport, $request->file('file_excel'));

    //     return redirect()->back()->with('success', 'Products imported successfully.');
    // }


    // public function import(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|mimes:xlsx,xls,csv'
    //     ]);

    //     Excel::import(new ProductsImport, $request->file('file'));

    //     // return response()->json(['message' => 'Products imported successfully!'], 200);
    //     return redirect()->back()->with('success', 'Products imported successfully.');

    // }
    public function import(Request $request)
    {
        $file = $request->file('file');
        $import = new ProductsImport($file);

        Excel::import($import, $file);

        return redirect()->back()->with('created', 'Thêm mới sản phẩm thành công!');
    }



    public function export(Request $request)
    {
        $paginate = $request->input('paginate(10)', 'all');

        $export = new ProductsExport($paginate);

        return Excel::download($export, 'products.xlsx');
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

        if ($dataProduct['img_thumbnail']) {
            $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
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
                if ($dataProductVariant['image']) {
                    $dataProductVariant['image'] = Storage::put('products', $dataProductVariant['image']);
                }
                ProductVariant::query()->create($dataProductVariant);
            };
            $product->tags()->sync($dataProductTags);
            foreach ($dataProductGalleries as $image) {
                ProductGallery::query()->create([
                    'product_id' => $product->id,
                    'image' => Storage::put('products', $image)
                ]);
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
        // Lấy dữ liệu sản phẩm từ request
        $dataProduct = $request->except(['product_variants', 'tags', 'product_galleries']);
        $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
        $dataProduct['is_hot_deal'] = isset($dataProduct['is_hot_deal']) ? 1 : 0;
        $dataProduct['is_new'] = isset($dataProduct['is_new']) ? 1 : 0;
        $dataProduct['is_show_home'] = isset($dataProduct['is_show_home']) ? 1 : 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];

        // Lấy sản phẩm cần cập nhật từ database
        $product = Product::findOrFail($id);

        // Xử lý ảnh đại diện (Thumbnail)
        if ($request->hasFile('img_thumbnail')) {
            // Xóa ảnh đại diện cũ nếu có
            if ($product->img_thumbnail) {
                Storage::delete($product->img_thumbnail);
            }
            // Lưu ảnh mới và cập nhật đường dẫn
            $dataProduct['img_thumbnail'] = Storage::put('products', $request->file('img_thumbnail'));
        } else {
            // Giữ nguyên ảnh đại diện cũ nếu không có ảnh mới
            $dataProduct['img_thumbnail'] = $product->img_thumbnail;
        }

        // Xử lý biến thể sản phẩm (Variants)
        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];
        foreach ($dataProductVariantsTmp as $key => $item) {
            $tmp = explode('-', $key);
            $variantData = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $item['quantity'],
            ];

            // Kiểm tra xem biến thể này có ảnh hiện tại không
            $existingVariant = $product->variants()->where('product_size_id', $tmp[0])->where('product_color_id', $tmp[1])->first();
            if ($existingVariant && isset($item['image'])) {
                // Xóa ảnh cũ nếu có và lưu ảnh mới
                if ($existingVariant->image) {
                    Storage::delete($existingVariant->image);
                }
                $variantData['image'] = Storage::put('products', $item['image']);
            } elseif ($existingVariant) {
                // Giữ nguyên ảnh nếu không có ảnh mới
                $variantData['image'] = $existingVariant->image;
            } elseif (isset($item['image'])) {
                // Lưu ảnh mới nếu là biến thể mới
                $variantData['image'] = Storage::put('products', $item['image']);
            }

            $dataProductVariants[] = $variantData;
        }

        // Xử lý các thẻ (Tags)
        $dataProductTags = $request->tags;

        // Xử lý thư viện ảnh (Galleries)
        $dataProductGalleries = $request->file('product_galleries');
        if ($dataProductGalleries) {
            // Lấy danh sách galleries hiện tại của sản phẩm
            $existingGalleries = $product->galleries()->pluck('image')->toArray();

            foreach ($dataProductGalleries as $image) {
                // Kiểm tra xem ảnh này đã tồn tại trong galleries hay chưa
                if (!in_array(Storage::put('products', $image), $existingGalleries)) {
                    // Nếu không tồn tại, tạo mới bản ghi trong galleries
                    ProductGallery::create([
                        'product_id' => $product->id,
                        'image' => Storage::put('products', $image)
                    ]);
                }
            }
        }

        try {
            DB::beginTransaction();

            // Cập nhật thông tin sản phẩm
            $product->update($dataProduct);

            // Cập nhật hoặc thêm mới biến thể sản phẩm
            foreach ($dataProductVariants as $dataProductVariant) {
                $product->variants()->updateOrCreate(
                    ['product_size_id' => $dataProductVariant['product_size_id'], 'product_color_id' => $dataProductVariant['product_color_id']],
                    $dataProductVariant
                );
            }

            // Đồng bộ hóa các thẻ sản phẩm
            $product->tags()->sync($dataProductTags);

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return back()->withErrors(['error' => 'Something went wrong!']);
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
            return back();
        } catch (\Exception $exception) {
            return back();
        }
    }
    public function search(Request $request)
    {
        $search = $request->input('q');
        $tags = Tag::where('name', 'LIKE', "%{$search}%")->get();
        return response()->json($tags);
    }


    public function deleteGallery(Request $request)
    {
        $galleryId = $request->input('gallery_id');
        $imageUrl = $request->input('image_url');

        try {
            // Delete from database
            $gallery = ProductGallery::findOrFail($galleryId);
            $gallery->delete();

            // Delete image file
            Storage::delete($imageUrl);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }


    // app/Http/Controllers/ProductController.php


    public function searchProducts(Request $request)
    {
        $search = $request->input('term');

        $products = Product::whereDoesntHave('sales')
            ->where('name', 'LIKE', "%{$search}%")
            ->get(['id', 'name']);

        return response()->json($products);
    }
}


















