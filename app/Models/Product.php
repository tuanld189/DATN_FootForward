<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_id',
        'brand_id',
        'name',
        'sku',
        'slug',
        'description',
        'status',
        'img_thumbnail',
        'price',
        'view_count',
        'quantity',
        'content',
        'created_at',
        'updated_at',
    ];
    protected $casts=[
        'is_hot_deal' => 'boolean',
        'is_new' => 'boolean',
        'is_show_home' => 'boolean',


    ];
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    // để lấy nhiều tag
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}
