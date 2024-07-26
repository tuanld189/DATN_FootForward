<?php
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
            // echo '<pre>';
            // print_r($row);
            // echo '</pre>';

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
