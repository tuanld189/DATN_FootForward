<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_price',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sale_product');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true)
                     ->where('start_date', '<=', now())
                     ->where('end_date', '>=', now());
    }
}
