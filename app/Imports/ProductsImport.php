<?php

// namespace App\Imports;

// use App\Models\Product;
// use Maatwebsite\Excel\Concerns\ToModel;

// class ProductImport implements ToModel
// {
//     /**
//     * @param array $row
//     *
//     * @return \Illuminate\Database\Eloquent\Model|null
//     */
//     public function model(array $row)
//     {
//         return new Product([
//             //
//         ]);
//     }
// }


// namespace App\Imports;

// use App\Models\Product;
// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\WithValidation;

// class ProductImport implements ToModel, WithHeadingRow, WithValidation
// {
//     public function model(array $row)
//     {
//         // dd($row);
//         return new Product([
//             'category_id'  => $row['category_id'],
//             'brand_id'     => $row['brand_id'],
//             'name'         => $row['name'],
//             'sku'          => $row['sku'],
//             'slug'         => $row['slug'] ?? null,
//             'description'  => $row['description'] ?? null,
//             'img_thumbnail'=> $row['img_thumbnail'] ?? null,
//             'price'        => $row['price'] ?? null,
//             'view_count'   => $row['view_count'] ?? null,
//             'content'      => $row['content'] ?? null,
//             'is_active'    => $row['is_active'] ?? null,
//             'is_hot_deal'  => $row['is_hot_deal'] ?? null,
//             'is_new'       => $row['is_new'] ?? null,
//             'is_show_home' => $row['is_show_home'] ?? null,
//         ]);
//     }

//     public function rules(): array
//     {
//         return [
//             '*.name' => 'required|string',
//             '*.sku' => 'required|string|unique:products,sku',
//             '*.price' => 'required|numeric',
//             '*.category_id' => 'required|exists:categories,id',
//             '*.brand_id' => 'required|exists:brands,id',
//             // Add other validation rules as needed
//         ];
//     }
// }


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
//         // foreach ($rows as $row) {
//         // Tạo sản phẩm mới từ dữ liệu trong mỗi dòng của tệp Excel
//         // dd($row);
//         // Product::create([
//         //     'category_id' => $row['category_id'],
//         //     'brand_id' => $row['brand_id'],
//         //     'name' => $row['name'],
//         //     'sku' => $row['sku'],
//         //     'slug' => $row['slug'],
//         //     'description' => $row['description'],
//         //     'img_thumbnail' => $row['img_thumbnail'],
//         //     'price' => floatval($row['price']), // Convert price to float
//         //     'view_count' => $row['view_count'],
//         //     'content' => $row['content'],
//         //     'is_active' => $row['is_active'],
//         //     'is_hot_deal' => $row['is_hot_deal'],
//         //     'is_new' => $row['is_new'],
//         //     'is_show_home' => $row['is_show_home'],
//         // ]);
//         // Product::create([
//         //     'category_id' => $row[0],
//         //     'brand_id' => $row[1],
//         //     'name' => $row[2],
//         //     'sku' => $row[3],
//         //     'slug' => $row[4],
//         //     'description' => $row[5],
//         //     'img_thumbnail' => $row[6],
//         //     'price' => floatval($row[7]), // Convert price to float
//         //     'view_count' => $row[8],
//         //     'content' => $row[9],
//         //     'is_active' => $row[10],
//         //     'is_hot_deal' => $row[11],
//         //     'is_new' => $row[12],
//         //     'is_show_home' => $row[13],
//         // ]);
//         // }


//         foreach ($rows as $row) {
//             // Debugging: Print out the contents of the $row array
//             // dd($row);

//             $categoryId = $row[0];
//             $brandId = $row[1];

//             // Check if the category and brand exist
//             $categoryExists = Category::find($categoryId);
//             $brandExists = Brand::find($brandId);

//             if (!$categoryExists) {
//                 // Handle the case where the category does not exist
//                 // You can log this or skip this row
//                 continue;
//             }

//             if (!$brandExists) {
//                 // Handle the case where the brand does not exist
//                 // You can log this or skip this row
//                 continue;
//             }

//             Product::create([
//                 'category_id' => $categoryId,
//                 'brand_id' => $brandId,
//                 'name' => $row[2],
//                 'sku' => $row[3],
//                 'slug' => $row[4],
//                 'description' => $row[5],
//                 'img_thumbnail' => $row[6],
//                 'price' => floatval($row[7]), // Convert price to float
//                 'view_count' => $row[8],
//                 'content' => $row[9],
//                 'is_active' => $row[10],
//                 'is_hot_deal' => $row[11],
//                 'is_new' => $row[12],
//                 'is_show_home' => $row[13],
//             ]);
//         }
//     }
// }


// namespace App\Imports;

// use App\Models\Product;
// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;

// class ProductsImport implements ToModel, WithHeadingRow
// {
//     public function model(array $row)
//     {
//         // dd($row);
//         return new Product([
//             'category_id'    => $row['category_id'],
//             'brand_id'       => $row['brand_id'],
//             'name'           => $row['name'],
//             'sku'            => $row['sku'],
//             'slug'           => $row['slug'],
//             'description'    => $row['description'],
//             'img_thumbnail'  => $row['img_thumbnail'],
//             'price'          => $row['price'],
//             'view_count'     => $row['view_count'],
//             'content'        => $row['content'],
//             'is_active'      => $row['is_active'],
//             'is_hot_deal'    => $row['is_hot_deal'],
//             'is_new'         => $row['is_new'],
//             'is_show_home'   => $row['is_show_home'],
//         ]);
//     }
// }


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
//             $categoryId = $row[0];
//             $brandId = $row[1];

//             $categoryExists = Category::find($categoryId);
//             $brandExists = Brand::find($brandId);

//             if (!$categoryExists || !$brandExists) {
//                 continue;
//             }

//             Product::create([
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
//                 'is_active' => $row[10],
//                 'is_hot_deal' => $row[11],
//                 'is_new' => $row[12],
//                 'is_show_home' => $row[13],
//             ]);
//         }
//     }
// }


namespace App\Imports;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Debugging: Print out the contents of the $row array
            // Log::info($row);
            echo '<pre>';
            print_r($row);
            echo '</pre>';

            $categoryId = $row[0];
            $brandId = $row[1];

            // Check if the category and brand exist
            $categoryExists = Category::find($categoryId);
            $brandExists = Brand::find($brandId);

            if (!$categoryExists || !$brandExists) {
                // Log or handle the error as needed
                continue;
            }

            // Debugging: Check if product is created
            $product = Product::create([
                'category_id' => $categoryId,
                'brand_id' => $brandId,
                'name' => $row[2],
                'sku' => $row[3],
                'slug' => $row[4],
                'description' => $row[5],
                'img_thumbnail' => $row[6],
                'price' => floatval($row[7]),
                'view_count' => $row[8],
                'content' => $row[9],
                // 'is_active' => $row[10],
                // 'is_hot_deal' => $row[11],
                // 'is_new' => $row[12],
                // 'is_show_home' => $row[13],
            ]);

            // Debugging: Check if the product was successfully created
            if ($product) {
                echo "Product {$product->name} created successfully.";
            } else {
                echo "Failed to create product.";
            }
        }
    }
}
