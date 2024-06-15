<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductGallery;
use App\Models\Tag;
use App\Models\Category;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    const PATH_VIEW='admin.products.';
    const PATH_UPLOAD='products';
    public function index()
    {
        $data = Product::query()->with(['category','tags'])->latest('id')->get();

        return view(self::PATH_VIEW . __FUNCTION__,compact('data'));



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('name','id')->all();
        $brands = Brand::query()->pluck('name','id')->all();
        $colors = ProductColor::query()->pluck('name','id')->all();
        $sizes = ProductSize::query()->pluck('name','id')->all();
        $tags = Tag::query()->pluck('name','id')->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact(['categories','brands','colors','sizes','tags']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataProduct = $request->except(['product_variants','tags','product_galleries']);

        $dataProduct['is_active'] = isset( $dataProduct['is_active']) ?1:0;
        $dataProduct['is_hot_deal'] = isset( $dataProduct['is_hot_deal']) ?1:0;
        $dataProduct['is_new'] = isset( $dataProduct['is_new']) ?1:0;
        $dataProduct['is_show_home'] = isset( $dataProduct['is_show_home']) ?1:0;
        $dataProduct['slug'] = Str::slug( $dataProduct['name']) .'-'. $dataProduct['sku'];

        if($dataProduct['img_thumbnail']){
            $dataProduct['img_thumbnail'] = Storage::put('products',$dataProduct['img_thumbnail']);
        }
        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants=[];
        foreach ($dataProductVariantsTmp as $key => $item){
            $tmp = explode('-',$key);
            $dataProductVariants[]=[
                'product_size_id'=> $tmp[0],
                'product_color_id'=> $tmp[1],
                'quantity'=>$item['quantity'],
                'image'=> $item['image'] ?? null,

            ];
        }

        $dataProductTags = $request->tags;
        $dataProductGalleries = $request->product_galleries ?: [];
        try{
            DB::beginTransaction();
            /** @var Product $product */
            $product = Product::query()->create($dataProduct);
            foreach($dataProductVariants as $dataProductVariant){
                $dataProductVariant['product_id'] = $product->id;
                if($dataProductVariant['image']){
                    $dataProductVariant['image'] = Storage::put('products',$dataProductVariant['image']);
                }
                ProductVariant::query()->create($dataProductVariant);
            };
            $product->tags()->sync($dataProductTags);
            foreach($dataProductGalleries as $image){
                ProductGallery::query()->create([
                    'product_id'=> $product->id,
                    'image'=> Storage::put('products',$image)
                ]);
            }

            DB::commit();
            return redirect()->route('admin.products.index');

        }catch(\Exception $exception){
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
        $model = Product::with(['category', 'brand', 'tags', 'galleries', 'variants'])->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
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

        // Handle Thumbnail Image
        if ($request->hasFile('img_thumbnail')) {
            // Delete old thumbnail if updating
            if ($product->img_thumbnail) {
                Storage::delete($product->img_thumbnail);
            }
            $dataProduct['img_thumbnail'] = Storage::put('products', $request->file('img_thumbnail'));
        } else {
            $dataProduct['img_thumbnail'] = $product->img_thumbnail;
        }

        // Variants
        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];
        foreach ($dataProductVariantsTmp as $key => $item) {
            $tmp = explode('-', $key);
            $variantData = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $item['quantity'],
            ];

            // Check if there's an existing image for this variant
            $existingVariant = $product->variants()->where('product_size_id', $tmp[0])->where('product_color_id', $tmp[1])->first();
            if ($existingVariant && isset($item['image'])) {
                // Delete old image if updating
                if ($existingVariant->image) {
                    Storage::delete($existingVariant->image);
                }
                $variantData['image'] = Storage::put('products', $item['image']);
            } elseif ($existingVariant) {
                // Keep the existing image if not updated
                $variantData['image'] = $existingVariant->image;
            } elseif (isset($item['image'])) {
                // New image for a new variant
                $variantData['image'] = Storage::put('products', $item['image']);
            }

            $dataProductVariants[] = $variantData;
        }

        // Tags, Galleries
        $dataProductTags = $request->tags;
        $dataProductGalleries = $request->product_galleries ?: [];

        try {
            DB::beginTransaction();

            // Update Product information
            $product->update($dataProduct);

            // Update Product Variants
            foreach ($dataProductVariants as $dataProductVariant) {
                $product->variants()->updateOrCreate(
                    ['product_size_id' => $dataProductVariant['product_size_id'], 'product_color_id' => $dataProductVariant['product_color_id']],
                    $dataProductVariant
                );
            }

            // Sync Tags
            $product->tags()->sync($dataProductTags);

            // Handle Galleries
            $existingGalleries = $product->galleries()->get();

            // Process each gallery input
            foreach ($dataProductGalleries as $index => $image) {
                // Check if a new image is uploaded for this index
                if ($image) {
                    // If existing gallery exists for this index, update it
                    if (isset($existingGalleries[$index])) {
                        // Delete old image if updating
                        if ($existingGalleries[$index]->image) {
                            Storage::delete($existingGalleries[$index]->image);
                        }
                        // Update image for existing gallery
                        $existingGalleries[$index]->image = Storage::put('products', $image);
                        $existingGalleries[$index]->save();
                    } else {
                        // If no existing gallery, create a new one
                        ProductGallery::create([
                            'product_id' => $product->id,
                            'image' => Storage::put('products', $image)
                        ]);
                    }
                }
            }

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
        try{
            DB::transaction(function () use ($product){
                $product->tags()->sync([]);
                $product->galleries()->delete();
                $product->variants()->delete();
                $product->delete();

            },3);
            return back();

        }catch(\Exception $exception){
            return back();

        }
    }
}
