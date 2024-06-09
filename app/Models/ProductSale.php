<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'status',
        'price',
        'view_count',
        'quantity',
        'content',
        'start_date',
        'end_date',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
