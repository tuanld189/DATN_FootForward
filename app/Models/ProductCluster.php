<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class ProductCluster extends Model
// {
//     use HasFactory;

//     protected $fillable = ['name'];

//     public function products()
//     {
//         return $this->hasMany(Product::class);
//     }
    
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCluster extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_cluster_product');
    }
}

