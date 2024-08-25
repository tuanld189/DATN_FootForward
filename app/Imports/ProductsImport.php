<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow, WithDrawings
{
    private $drawings = [];

    public function drawings(): array
    {
        return $this->drawings;
    }

    public function model(array $row)
    {
        Log::info('Processing row:', $row);

        $imgThumbnailPath = null;

        // Ánh xạ hình ảnh với dòng dữ liệu
        if (isset($this->drawings[$row['sku']])) {
            Log::info('Image found for SKU:', ['sku' => $row['sku']]);
            $drawing = $this->drawings[$row['sku']];
            $imgThumbnailPath = $this->handleImage($drawing);
            Log::info('Thumbnail path generated:', ['imgThumbnailPath' => $imgThumbnailPath]);
        } else {
            Log::warning('No image found for SKU:', ['sku' => $row['sku']]);
        }

        // Tạo hoặc cập nhật sản phẩm
        $product = Product::updateOrCreate(
            ['slug' => $row['slug']],
            [
                'category_id' => $row['category_id'],
                'brand_id' => $row['brand_id'],
                'name' => $row['name'],
                'sku' => $row['sku'],
                'slug' => $row['slug'],
                'description' => $row['description'],
                // 'img_thumbnail' => $imgThumbnailPath,
                'img_thumbnail' => $row['img_thumbnail'],
                'price' => $row['price'],
            ]
        );

        Log::info('Product created or updated:', ['product_id' => $product->id, 'slug' => $row['slug']]);
        // dd($row);
        return $product;
    }

    private function handleImage(Drawing $drawing)
    {
        try {
            $imageName = Str::random(10) . '.' . $drawing->getExtension();
            $imageContent = file_get_contents($drawing->getPath());

            // Lưu ảnh vào thư mục công khai
            $filePath = 'public/products/' . $imageName;
            Storage::put($filePath, $imageContent);

            return Storage::url($filePath); // Trả về đường dẫn ảnh
        } catch (\Exception $e) {
            \Log::error('Error handling image: ' . $e->getMessage());
            return null;
        }
    }

    // Phương thức này ánh xạ các hình ảnh với các dòng trong file Excel
    public function drawingsFromArray(array $drawings)
    {
        $mappedDrawings = [];
        foreach ($drawings as $drawing) {
            if ($drawing instanceof Drawing) {
                $row = $drawing->getCoordinates();
                $mappedDrawings[$row] = $drawing;
            }
        }
        $this->drawings = $mappedDrawings;
    }
}
