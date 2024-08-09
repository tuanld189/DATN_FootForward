<?php

// namespace App\Exports;

// use App\Models\Product;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;
// use Illuminate\Support\Facades\DB;

// class ProductsExport implements FromCollection, WithHeadings
// {
//     public function collection()
//     {
//         return DB::table('products')
//             ->join('brands', 'products.brand_id', '=', 'brands.id')
//             ->join('categories', 'products.category_id', '=', 'categories.id')
//             ->select(
//                 'products.id',
//                 'products.category_id',
//                 'categories.name as category_name',
//                 'products.brand_id',
//                 'brands.name as brand_name',
//                 'products.name',
//                 'products.sku',
//                 'products.slug',
//                 'products.description',
//                 'products.img_thumbnail',
//                 'products.price',
//                 'products.view_count',
//                 'products.content',
//                 'products.is_active',
//                 'products.is_hot_deal',
//                 'products.is_new',
//                 'products.is_show_home',
//                 'products.created_at',
//                 'products.updated_at'
//             )
//             ->get();
//     }

//     public function headings(): array
//     {
//         return [
//             'ID',
//             'Category ID',
//             'Category Name',
//             'Brand ID',
//             'Brand Name',
//             'Name',
//             'SKU',
//             'Slug',
//             'Description',
//             'Img Thumbnail',
//             'Price',
//             'View Count',
//             'Content',
//             'Is Active',
//             'Is Hot Deal',
//             'Is New',
//             'Is Show Home',
//             'Created At',
//             'Updated At',
//         ];
//     }
// }



// namespace App\Exports;

// use App\Models\Product;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithMapping;

// class ProductsExport implements FromCollection, WithHeadings, WithMapping
// {
//     public function collection()
//     {
//         return Product::all();
//     }

//     public function map($product): array
//     {
//         return [
//             $product->category_id,
//             $product->brand_id,
//             $product->name,
//             $product->sku,
//             $product->slug,
//             $product->description,
//             $product->img_thumbnail ? asset($product->img_thumbnail) : null, // URL of the image
//             $product->price,
//             $product->view_count,
//             $product->content,
//             $product->is_active,
//             $product->is_hot_deal,
//             $product->is_new,
//             $product->is_show_home,
//         ];
//     }

//     public function headings(): array
//     {
//         return [
//             'Category ID',
//             'Brand ID',
//             'Name',
//             'SKU',
//             'Slug',
//             'Description',
//             'Image Thumbnail', // Column header for image URL
//             'Price',
//             'View Count',
//             'Content',
//             'Is Active',
//             'Is Hot Deal',
//             'Is New',
//             'Is Show Home',
//         ];
//     }
// }




namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Support\Str;

class ProductsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    protected $paginate;

    public function __construct($paginate)
    {
        $this->paginate = $paginate;
    }

    public function collection()
    {
        if ($this->paginate === 'all') {
            return Product::latest('id')->get();
        } else {
            return Product::latest('id')->paginate($this->paginate)->items();
        }
    }

    public function map($product): array
    {
        return [
            $product->category_id,
            $product->brand_id,
            $product->name,
            $product->sku,
            $product->slug,
            $product->description,
            $product->img_thumbnail ? asset($product->img_thumbnail) : null, // URL of the image
            $product->price,
            $product->view_count,
            $product->content,
            $product->is_active,
            $product->is_hot_deal,
            $product->is_new,
            $product->is_show_home,
        ];
    }

    public function headings(): array
    {
        return [
            'Category ID',
            'Brand ID',
            'Name',
            'SKU',
            'Slug',
            'Description',
            'Image Thumbnail', // Column header for image URL
            'Price',
            'View Count',
            'Content',
            'Is Active',
            'Is Hot Deal',
            'Is New',
            'Is Show Home',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Căn giữa nội dung theo chiều ngang cho hàng đầu tiên
        $sheet->getStyle('1')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // Căn giữa nội dung trên và dưới trong toàn bộ bảng tính
        $highestColumn = $sheet->getHighestColumn();
        $highestRow = $sheet->getHighestRow();

        $sheet->getStyle("A1:$highestColumn$highestRow")->applyFromArray([
            'alignment' => [
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        for ($row = 2; $row <= $highestRow; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(130);
        }

        return [
            // Có thể thêm các kiểu dáng khác ở đây nếu cần
        ];
    }

    public function registerEvents(): array
    {
        return [
            // Khi tệp được xuất, điều chỉnh chiều rộng cột
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $products = $this->collection();
                $rowIndex = 2; // Bắt đầu từ hàng 2, vì hàng 1 là tiêu đề

                foreach ($products as $product) {
                    if ($product->img_thumbnail) {
                        $path = parse_url($product->img_thumbnail, PHP_URL_PATH);
                        $path = str_replace('/storage', '', $path);
                        $imagePath = storage_path('app/public' . $path);

                        if (file_exists($imagePath)) {
                            $drawing = new Drawing();
                            $drawing->setName($product->name);
                            $drawing->setPath($imagePath);
                            $drawing->setWidth(200);
                            $drawing->setHeight(150);
                            $drawing->setCoordinates("G$rowIndex");
                            $drawing->setWorksheet($sheet);
                            $drawing->setOffsetX(5);
                            $drawing->setOffsetY(5);
                        }
                    }
                    $rowIndex++;
                }

                // Điều chỉnh chiều rộng cột tự động
                foreach (range('A', $sheet->getHighestColumn()) as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                $sheet->getColumnDimension('G')->setAutoSize(false);
                $sheet->getColumnDimension('G')->setWidth(30);
            },
        ];
    }
}

