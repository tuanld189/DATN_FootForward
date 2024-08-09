<?php
// namespace App\Imports;

// use App\Models\Brand;
// use App\Models\Category;
// use App\Models\Product;
// use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\ToCollection;

// class ProductsImport implements ToCollection
// {
//     public function collection(Collection $rows)
//     {
//         foreach ($rows as $row) {
//             // Debugging: Print out the contents of the $row array
//             // Log::info($row);
//             // echo '<pre>';
//             // print_r($row);
//             // echo '</pre>';

//             $categoryId = $row[0];
//             $brandId = $row[1];

//             // Check if the category and brand exist
//             $categoryExists = Category::find($categoryId);
//             $brandExists = Brand::find($brandId);

//             if (!$categoryExists || !$brandExists) {
//                 // Log or handle the error as needed
//                 continue;
//             }

//             // Debugging: Check if product is created
//             $product = Product::create([
//                 'category_id' => $categoryId,
//                 'brand_id' => $brandId,
//                 'name' => $row[2],
//                 'sku' => $row[3],
//                 'slug' => $row[4],
//                 'description' => $row[5],
//                 'img_thumbnail' => $row[6],
//                 'price' => floatval($row[7]),
//                 'view_count' => $row[8],
//                 'content' => $row[9],
//                 // 'is_active' => $row[10],
//                 // 'is_hot_deal' => $row[11],
//                 // 'is_new' => $row[12],
//                 // 'is_show_home' => $row[13],
//             ]);

//             // Debugging: Check if the product was successfully created
//             if ($product) {
//                 echo "Product {$product->name} created successfully.";
//             } else {
//                 echo "Failed to create product.";
//             }
//         }
//     }
// }






// namespace App\Imports;

// use App\Models\Brand;
// use App\Models\Category;
// use App\Models\Product;
// use App\Models\Tag;
// use Illuminate\Support\Collection;
// use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Concerns\ToCollection;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\WithChunkReading;
// use Maatwebsite\Excel\Concerns\WithValidation;
// use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
// use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
// use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
// use Illuminate\Support\Str;

// class ProductsImport extends DefaultValueBinder implements ToCollection, WithHeadingRow, WithChunkReading, WithValidation
// {
//     protected $file;
//     protected $errors = [];

//     public function __construct($file)
//     {
//         $this->file = $file;
//     }
//     private function saveImage($drawing, $product_name)
//     {
//         $image_name = Str::slug($product_name);
//         $drawing_path = $drawing->getPath();
//         $extension = $drawing->getExtension();

//         $img_url = "/storage/app/public/photos/1/PRODUCT/{$image_name}.{$extension}";
//         $img_path = public_path($img_url);

//         // Xóa ảnh cũ nếu tồn tại
//         if (file_exists($img_path)) {
//             unlink($img_path);
//         }

//         // Đảm bảo thư mục tồn tại trước khi lưu ảnh
//         if (!file_exists(dirname($img_path))) {
//             mkdir(dirname($img_path), 0777, true);
//         }

//         $contents = file_get_contents($drawing_path);
//         file_put_contents($img_path, $contents);

//         $envUrl = env('APP_URL');
//         return "{$envUrl}{$img_url}";
//     }

//     private function getImagesFromSpreadsheet($spreadsheet, $product_names)
//     {
//         $sheet = $spreadsheet->getActiveSheet();
//         $drawings = $sheet->getDrawingCollection();
//         $images = [];

//         foreach ($drawings as $index => $drawing) {
//             if ($drawing instanceof Drawing) {
//                 $product_name = $product_names[$index] ?? 'image_' . $index;
//                 $images[] = $this->saveImage($drawing, $product_name);
//             }
//         }

//         return $images;
//     }

//     private function syncTags(array $tags)
//     {
//         $tagIds = [];

//         foreach ($tags as $tagName) {
//             $tag = Tag::firstOrCreate(['name' => $tagName]);
//             $tagIds[] = $tag->id;
//         }

//         return $tagIds;
//     }

//     public function collection(Collection $rows)
//     {
//         $reader = new Xlsx();
//         $spreadsheet = $reader->load($this->file);

//         $product_names = $rows->pluck('ten_san_pham')->toArray();
//         $images = $this->getImagesFromSpreadsheet($spreadsheet, $product_names);

//         DB::beginTransaction();
//         $this->errors = [];

//         try {
//             foreach ($rows as $index => $row) {
//                 $imageValue = isset($images[$index]) ? $images[$index] : null;

//                 $productName = trim($row['ten_san_pham']);
//                 $categoryName = trim($row['ten_danh_muc']);
//                 $brandName = trim($row['ten_thuong_hieu']);
//                 $tags = array_map('trim', explode(',', trim($row['ten_nhan'])));
//                 $content = trim($row['noi_dung']);

//                 // Chuyển đổi các dòng xuống dòng thành thẻ HTML <br>
//                 $content = nl2br($content);

//                 // Tra cứu category_id và brand_id từ tên
//                 $category = Category::where('name', $categoryName)->first();
//                 $brand = Brand::where('name', $brandName)->first();

//                 if (!$category || !$brand) {
//                     $this->errors[] = [
//                         'row' => $row,
//                         'error' => 'Invalid category or brand.'
//                     ];
//                     continue;
//                 }

//                 $productData = [
//                     'name' => $productName,
//                     'image' => $imageValue,
//                     'category_id' => $category->id,
//                     'brand_id' => $brand->id,
//                     'price' => trim($row['gia_vnd']),
//                     'view_count' => trim($row['so_luong']),
//                     'content' => $content,
//                     'sku' => trim($row['sku']),
//                     'slug' => Str::slug($productName),
//                     'description' => trim($row['mo_ta']),
//                     'img_thumbnail' => $imageValue,
//                     'is_active' => filter_var($row['is_active'], FILTER_VALIDATE_BOOLEAN),
//                     'is_hot_deal' => filter_var($row['is_hot_deal'], FILTER_VALIDATE_BOOLEAN),
//                     'is_new' => filter_var($row['is_new'], FILTER_VALIDATE_BOOLEAN),
//                     'is_show_home' => filter_var($row['is_show_home'], FILTER_VALIDATE_BOOLEAN),
//                 ];

//                 $existingProduct = Product::where('name', $productName)->first();

//                 if ($existingProduct) {
//                     // Cập nhật sản phẩm hiện có
//                     $existingProduct->update($productData);
//                     $existingProduct->tags()->sync($this->syncTags($tags));
//                 } else {
//                     // Tạo sản phẩm mới
//                     $product = Product::create($productData);
//                     $product->tags()->attach($this->syncTags($tags));
//                 }
//             }

//             dd([
//                 'productData' => $productData,
//                 'existingProduct' => $existingProduct ?? null,
//                 'row' => $row,
//                 'imageValue' => $imageValue,
//                 'tags' => $tags,
//                 'category' => $category,
//                 'brand' => $brand,
//             ]);

//             DB::commit();
//         } catch (\Exception $e) {
//             DB::rollBack();
//             // Xử lý lỗi hoặc ghi log lỗi ở đây
//             $this->errors[] = ['error' => 'Error importing products: ' . $e->getMessage()];
//         }
//     }

//     public function chunkSize(): int
//     {
//         return 1000;
//     }

//     public function rules(): array
//     {
//         return [
//             'ten_san_pham' => 'required',
//             'ten_danh_muc' => 'required|exists:categories,name',
//             'ten_thuong_hieu' => 'required|exists:brands,name',
//             'gia_vnd' => 'required|numeric',
//             'so_luong' => 'required|integer',
//             'sku' => 'nullable|string',
//             'slug' => 'nullable|string',
//             'mo_ta' => 'nullable|string',
//             'is_active' => 'nullable|boolean',
//             'is_hot_deal' => 'nullable|boolean',
//             'is_new' => 'nullable|boolean',
//             'is_show_home' => 'nullable|boolean',
//             'ten_nhan' => 'nullable|exists:tags,name',
//         ];
//     }

//     public function customValidationMessages()
//     {
//         return [
//             'ten_san_pham.required' => 'Tên sản phẩm là bắt buộc.',
//             'ten_danh_muc.required' => 'Danh mục là bắt buộc.',
//             'ten_danh_muc.exists' => 'Danh mục không tồn tại.',
//             'ten_thuong_hieu.required' => 'Thương hiệu là bắt buộc.',
//             'ten_thuong_hieu.exists' => 'Thương hiệu không tồn tại.',
//             'gia_vnd.required' => 'Giá là bắt buộc.',
//             'gia_vnd.numeric' => 'Giá phải là số.',
//             'so_luong.required' => 'Số lượng là bắt buộc.',
//             'so_luong.integer' => 'Số lượng phải là số nguyên.',
//             'sku.string' => 'SKU phải là chuỗi.',
//             'slug.string' => 'Slug phải là chuỗi.',
//             'mo_ta.string' => 'Mô tả phải là chuỗi.',
//             'is_active.boolean' => 'Trạng thái hoạt động phải là boolean.',
//             'is_hot_deal.boolean' => 'Trạng thái ưu đãi nóng phải là boolean.',
//             'is_new.boolean' => 'Trạng thái mới phải là boolean.',
//             'is_show_home.boolean' => 'Trạng thái hiển thị trên trang chủ phải là boolean.',
//             'ten_nhan.exists' => 'Nhãn không tồn tại.',
//         ];
//     }

//     public function getErrors()
//     {
//         return $this->errors;
//     }
// }


// namespace App\Imports;

// use App\Models\Product;
// use Illuminate\Http\UploadedFile;
// use Illuminate\Support\Facades\Storage;
// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;

// class ProductsImport implements ToModel, WithHeadingRow
// {
//     public function model(array $row)
//     {
//         $imgThumbnailPath = null;

//         if (isset($row['img_thumbnail']) && $row['img_thumbnail'] instanceof UploadedFile) {
//             $imageName = time().'.'.$row['img_thumbnail']->getClientOriginalExtension();
//             $row['img_thumbnail']->storeAs('public/images', $imageName);
//             $imgThumbnailPath = 'images/'.$imageName;
//         }

//         return new Product([
//             'category_id' => $row['category_id'],
//             'brand_id' => $row['brand_id'],
//             'name' => $row['name'],
//             'sku' => $row['sku'],
//             'slug' => $row['slug'],
//             'description' => $row['description'],
//             'img_thumbnail' => $imgThumbnailPath,
//             'price' => $row['price'],
//             // 'tags' => $row['tags'],
//             'view_count' => $row['view_count'],
//             'content' => $row['content'],
//         ]);
//     }
// }




// namespace App\Imports;

// use App\Models\Product;
// use App\Models\Tag;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Str;
// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Illuminate\Support\Facades\Log;

// class ProductsImport implements ToModel, WithHeadingRow
// {
//     public function model(array $row)
//     {
//         $imgThumbnailPath = null;

//         // Handle image URL or Base64 string
//         if (isset($row['img_thumbnail'])) {
//             $imgThumbnailPath = $this->handleImage($row['img_thumbnail']);
//             Log::info('Image path: ' . $imgThumbnailPath);
//         }
//         // Create or update the product
//         $product = Product::updateOrCreate(
//             ['slug' => $row['slug']], // Update by slug to prevent duplicates
//             [
//                 'category_id' => $row['category_id'],
//                 'brand_id' => $row['brand_id'],
//                 'name' => $row['name'],
//                 'sku' => $row['sku'],
//                 'slug' => $row['slug'],
//                 'description' => $row['description'],
//                 'img_thumbnail' => $imgThumbnailPath,
//                 'price' => $row['price'],
//                 'view_count' => $row['view_count'],
//                 'content' => $row['content'],
//             ]
//         );

//         // Process tags
//         if (isset($row['tags'])) {
//             $this->importTags($product, $row['tags']);
//         }

//         return $product;
//     }

//     private function handleImage($imageData)
//     {
//         try {
//             // Check if the image data is a URL
//             if (filter_var($imageData, FILTER_VALIDATE_URL)) {
//                 $imageContent = file_get_contents($imageData);
//                 $imageName = Str::random(10) . '.jpg';
//             }
//             // Check if the image data is Base64
//             elseif (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
//                 $imageData = substr($imageData, strpos($imageData, ',') + 1);
//                 $imageContent = base64_decode($imageData);
//                 $imageType = strtolower($type[1]);
//                 $imageName = Str::random(10) . '.' . $imageType;
//             } else {
//                 Log::warning('Invalid image data: ' . $imageData);
//                 return null;
//             }

//             $filePath = 'public/storage/products/' . $imageName;
//             Storage::put($filePath, $imageContent);

//             return 'storage/products/' . $imageName;
//         } catch (\Exception $e) {
//             Log::error('Error handling image: ' . $e->getMessage());
//             return null;
//         }
//     }




//     private function importTags(Product $product, $tagsString)
//     {
//         $tags = array_map('trim', explode(',', $tagsString));
//         $tagIds = [];

//         foreach ($tags as $tagName) {
//             $tag = Tag::firstOrCreate(['name' => $tagName]);
//             $tagIds[] = $tag->id;
//         }

//         $product->tags()->sync($tagIds);
//     }
// }





// namespace App\Imports;

// use App\Models\Product;
// use App\Models\Tag;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Str;
// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Illuminate\Support\Facades\Log;

// class ProductsImport implements ToModel, WithHeadingRow
// {
//     public function model(array $row)
//     {
//         $imgThumbnailPath = null;

//         // Handle image URL or Base64 string
//         if (isset($row['img_thumbnail'])) {
//             $imgThumbnailPath = $this->handleImage($row['img_thumbnail']);
//             Log::info('Image path: ' . $imgThumbnailPath);
//         }

//         // Create or update the product
//         $product = Product::updateOrCreate(
//             ['slug' => $row['slug']], // Update by slug to prevent duplicates
//             [
//                 'category_id' => $row['category_id'],
//                 'brand_id' => $row['brand_id'],
//                 'name' => $row['name'],
//                 'sku' => $row['sku'],
//                 'slug' => $row['slug'],
//                 'description' => $row['description'],
//                 'img_thumbnail' => $imgThumbnailPath,
//                 'price' => $row['price'],
//                 'view_count' => $row['view_count'],
//                 'content' => $row['content'],
//             ]
//         );

//         // Process tags
//         if (isset($row['tags'])) {
//             $this->importTags($product, $row['tags']);
//         }

//         return $product;
//     }

//     private function handleImage($imageData)
//     {
//         try {
//             // Check if the image data is a URL
//             if (filter_var($imageData, FILTER_VALIDATE_URL)) {
//                 $imageContent = file_get_contents($imageData);
//                 $imageName = Str::random(10) . '.jpg';
//             }
//             // Check if the image data is Base64
//             elseif (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
//                 $imageData = substr($imageData, strpos($imageData, ',') + 1);
//                 $imageContent = base64_decode($imageData);
//                 $imageType = strtolower($type[1]);
//                 $imageName = Str::random(10) . '.' . $imageType;
//             } else {
//                 Log::warning('Invalid image data: ' . $imageData);
//                 return null;
//             }

//             $filePath = 'public/products/' . $imageName;
//             Storage::put($filePath, $imageContent);

//             return 'products/' . $imageName;
//         } catch (\Exception $e) {
//             Log::error('Error handling image: ' . $e->getMessage());
//             return null;
//         }
//     }

//     private function importTags(Product $product, $tagsString)
//     {
//         $tags = array_map('trim', explode(',', $tagsString));
//         $tagIds = [];

//         foreach ($tags as $tagName) {
//             $tag = Tag::firstOrCreate(['name' => $tagName]);
//             $tagIds[] = $tag->id;
//         }

//         $product->tags()->sync($tagIds);
//     }
// }


namespace App\Imports;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $imgThumbnailPath = null;

        // Handle image URL or Base64 string
        if (isset($row['img_thumbnail']) && !empty($row['img_thumbnail'])) {
            $imgThumbnailPath = $this->handleImage($row['img_thumbnail']);
            Log::info('Image path: ' . $imgThumbnailPath);
        }

        // Create or update the product
        $product = Product::updateOrCreate(
            ['slug' => $row['slug']], // Update by slug to prevent duplicates
            [
                'category_id' => $row['category_id'],
                'brand_id' => $row['brand_id'],
                'name' => $row['name'],
                'sku' => $row['sku'],
                'slug' => $row['slug'],
                'description' => $row['description'],
                'img_thumbnail' => $imgThumbnailPath,
                'price' => $row['price'],
                'view_count' => $row['view_count'],
                'content' => $row['content'],
            ]
        );

        // Process tags
        if (isset($row['tags'])) {
            $this->importTags($product, $row['tags']);
        }

        return $product;
    }

    private function handleImage($imageData)
    {
        try {
            Log::info('Handling image data', ['imageData' => $imageData]);

            $imageContent = null;
            $imageName = Str::random(10); // Generate random name
            // $extension = 'jpg'; // Default to jpg if not determined
            $extension = 'jpg'; // Default to jpg if not determined

            // Check if image data is a URL
            if (filter_var($imageData, FILTER_VALIDATE_URL)) {
                Log::info('Image data is a URL', ['url' => $imageData]);

                $imageContent = file_get_contents($imageData);
                if ($imageContent === false) {
                    Log::warning('Failed to get image content from URL', ['url' => $imageData]);
                    return null;
                }
                $extension = pathinfo($imageData, PATHINFO_EXTENSION) ?: 'jpg';
                Log::info('Image extension from URL', ['extension' => $extension]);
            }
            // Check if image data is Base64
            elseif (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                Log::info('Image data is Base64', ['base64Data' => substr($imageData, 0, 50)]);

                $imageData = substr($imageData, strpos($imageData, ',') + 1);
                $imageContent = base64_decode($imageData);
                if ($imageContent === false) {
                    Log::warning('Failed to decode Base64 image data');
                    return null;
                }
                $extension = strtolower($type[1]);
                Log::info('Image extension from Base64', ['extension' => $extension]);
            }
            // Check if image data is a local file path
            elseif (file_exists(public_path($imageData))) {
                Log::info('Image data is a local file path', ['path' => $imageData]);

                $imageContent = file_get_contents(public_path($imageData));
                if ($imageContent === false) {
                    Log::warning('Failed to get image content from local file', ['path' => $imageData]);
                    return null;
                }
                $extension = pathinfo($imageData, PATHINFO_EXTENSION) ?: 'jpg';
                Log::info('Image extension from local file', ['extension' => $extension]);
            } else {
                Log::warning('Invalid image data format', ['imageData' => $imageData]);
                return null;
            }

            $imageName .= '.' . $extension;
            $filePath = storage_path('app/public/products/' . $imageName);
            Log::info('File path for image', ['filePath' => $filePath]);

            // Ensure directory exists
            if (!file_exists(dirname($filePath))) {
                if (!mkdir(dirname($filePath), 0777, true)) {
                    Log::warning('Failed to create directory for image storage', ['directory' => dirname($filePath)]);
                    return null;
                }
                Log::info('Directory created', ['directory' => dirname($filePath)]);
            }

            // Save image to directory
            if (file_put_contents($filePath, $imageContent) === false) {
                Log::warning('Failed to store image at path', ['filePath' => $filePath]);
                return null;
            }
            Log::info('Image stored successfully', ['filePath' => $filePath]);

            // Return relative URL
            return 'storage/products/' . $imageName;
        } catch (\Exception $e) {
            Log::error('Error handling image', ['message' => $e->getMessage(), 'imageData' => $imageData]);
            return null;
        }
    }


    private function importTags(Product $product, $tagsString)
    {
        $tags = array_map('trim', explode(',', $tagsString));
        $tagIds = [];

        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        $product->tags()->sync($tagIds);
    }
}



// namespace App\Imports;

// use App\Models\Product;
// use App\Models\Tag;
// use Illuminate\Support\Collection;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Str;
// use PhpOffice\PhpSpreadsheet\IOFactory;
// use Maatwebsite\Excel\Concerns\ToCollection;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\WithChunkReading;

// class ProductsImport implements ToCollection, WithHeadingRow, WithChunkReading
// {
//     protected $file;

//     public function __construct($file)
//     {
//         $this->file = $file;
//     }

//     public function collection(Collection $rows)
//     {
//         try {
//             $reader = IOFactory::createReaderForFile($this->file);
//             $spreadsheet = $reader->load($this->file);

//             $product_names = $rows->pluck('name')->toArray();
//             $images = $this->getImagesFromSpreadsheet($spreadsheet, $product_names);

//             DB::beginTransaction();

//             foreach ($rows as $index => $row) {
//                 $imageValue = isset($images[$index]) ? $images[$index] : null;

//                 $productData = [
//                     'category_id' => $row['category_id'],
//                     'brand_id' => $row['brand_id'],
//                     'name' => $row['name'],
//                     'sku' => $row['sku'],
//                     'slug' => Str::slug($row['name']),
//                     'description' => $row['description'],
//                     'img_thumbnail' => $imageValue,
//                     'price' => $row['price'],
//                     'view_count' => $row['view_count'],
//                     'content' => $row['content'],
//                 ];

//                 // Create or update the product
//                 $product = Product::updateOrCreate(
//                     ['slug' => $productData['slug']],
//                     $productData
//                 );

//                 // Process tags
//                 if (isset($row['tags'])) {
//                     $this->importTags($product, $row['tags']);
//                 }
//             }

//             DB::commit();
//         } catch (\Exception $e) {
//             DB::rollBack();
//             Log::error('Error importing products: ' . $e->getMessage());
//         }
//     }

//     private function getImagesFromSpreadsheet($spreadsheet, $product_names)
//     {
//         // Your image extraction logic here
//     }

//     private function importTags(Product $product, $tagsString)
//     {
//         $tags = array_map('trim', explode(',', $tagsString));
//         $tagIds = [];

//         foreach ($tags as $tagName) {
//             $tag = Tag::firstOrCreate(['name' => $tagName]);
//             $tagIds[] = $tag->id;
//         }

//         $product->tags()->sync($tagIds);
//     }

//     public function chunkSize(): int
//     {
//         return 1000;
//     }
// }
