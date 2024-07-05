<?php

// namespace App\Exports;

// use App\Models\Product;
// use Maatwebsite\Excel\Concerns\FromCollection;

// class ProductsExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Product::all();
//     }
// }

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DB::table('products')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.id',
                'products.category_id',
                'categories.name as category_name',
                'products.brand_id',
                'brands.name as brand_name',
                'products.name',
                'products.sku',
                'products.slug',
                'products.description',
                'products.img_thumbnail',
                'products.price',
                'products.view_count',
                'products.content',
                'products.is_active',
                'products.is_hot_deal',
                'products.is_new',
                'products.is_show_home',
                'products.created_at',
                'products.updated_at'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Category ID',
            'Category Name',
            'Brand ID',
            'Brand Name',
            'Name',
            'SKU',
            'Slug',
            'Description',
            'Img Thumbnail',
            'Price',
            'View Count',
            'Content',
            'Is Active',
            'Is Hot Deal',
            'Is New',
            'Is Show Home',
            'Created At',
            'Updated At',
        ];
    }
}
