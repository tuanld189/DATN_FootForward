<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'image',
    ];
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
};
