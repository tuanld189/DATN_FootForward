<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',

    ];
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_size_product', 'product_size_id', 'product_id');
    }
}
