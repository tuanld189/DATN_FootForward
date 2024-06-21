<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable=[

        'product_id',
        'tag_id',

    ];

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}
