<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $fillable=[

        'name',
        'code',
        'created_at',
        'updated_at',
    ];
    protected $table='provinces';
}
