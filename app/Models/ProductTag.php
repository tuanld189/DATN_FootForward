<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;
    protected $fillable=[

        'product_id',
        'tag_id',
        'created_at',
        'updated_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }

}
