<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ini_set('memory_limit', '2G'); // Tăng lên 2GB nếu cần thiết

        Schema::disableForeignKeyConstraints();
        ProductVariant::truncate();
        ProductGallery::truncate();
        Product::truncate();
        ProductColor::truncate();
        ProductSize::truncate();
        DB::table('product_tag')->truncate();

        Tag::truncate();

        $faker = \Faker\Factory::create();

        // Create unique tags
        for ($i = 0; $i < 15; $i++) {
            Tag::create([
                'name' => $faker->unique()->word,
            ]);
        }

        // Size
        foreach (['36','37','38','39','40','41','42','43'] as $item) {
            ProductSize::create([
                'name' => $item
            ]);
        }

        // Color
        foreach (['Black','Red','White','Green','Blue','Gray'] as $item) {
            ProductColor::create([
                'name' => $item
            ]);
        }

        // PRODUCTS
        for ($i = 0; $i < 20; $i++) {
            $name = $faker->text(100);

            Product::create([
                'category_id' => rand(1, 4),
                'brand_id' => rand(1, 4),
                'name' => $name,
                'sku' => Str::slug($name) . '-' . Str::random(8),
                'slug' => Str::random(8) . $i,
                'img_thumbnail' => 'https://images.footlocker.com/is/image/EBFL2/21826015_a1?wid=578&hei=578&fmt=png-alpha',
                'price' => 600000,
            ]);
        }

        // GALLERY
        for ($i = 1; $i <= 20; $i++) {
            ProductGallery::insert([
                [
                    'product_id' => $i,
                    'image' => 'https://images.footlocker.com/is/image/EBFL2/54724093_a1?wid=578&hei=578&fmt=png-alpha',
                ],
                [
                    'product_id' => $i,
                    'image' => 'https://images.footlocker.com/is/image/EBFL2/54724093_a1?wid=578&hei=578&fmt=png-alpha',
                ],
                [
                    'product_id' => $i,
                    'image' => 'https://images.footlocker.com/is/image/EBFL2/54724093_a1?wid=578&hei=578&fmt=png-alpha',
                ]
            ]);
        }

        // TAGS
        for ($i = 1; $i <= 20; $i++) {
            DB::table('product_tag')->insert([
                [
                    'product_id' => $i,
                    'tag_id' => rand(1, 8),
                ],
                [
                    'product_id' => $i,
                    'tag_id' => rand(9, 15),
                ]
            ]);
        }

        // VARIANTS
        for ($productID = 1; $productID <= 20; $productID++) {
            $data = [];
            for ($sizeID = 1; $sizeID <= 8; $sizeID++) {
                for ($colorID = 1; $colorID <= 6; $colorID++) {
                    $data[] = [
                        'product_id' => $productID,
                        'product_size_id' => $sizeID,
                        'product_color_id' => $colorID,
                        'quantity' => 100,
                        'image' => 'https://images.footlocker.com/is/image/EBFL2/54724093_a1?wid=578&hei=578&fmt=png-alpha',
                    ];
                }
            }
            ProductVariant::insert($data);
        }

        Schema::enableForeignKeyConstraints();
    }
}
