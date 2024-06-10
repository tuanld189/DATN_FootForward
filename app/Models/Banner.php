<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'image',
        'is_active',
        'created_at',
        'updated_at',
    ];
    protected $casts=[
        'is_active' => 'boolean',
    ];
}
