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
        'description',
        'status',
        'image',
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
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // public function tags()
    // {
    //     return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    // }

}
