<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_variant_id',
        'quantity_add',
        'product_name',
        'product_sku',
        'product_image',
        'product_price',
        'product_sale_price',
        'variant_size_name',
        'variant_color_name',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
