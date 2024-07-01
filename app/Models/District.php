<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable=[

        'name',
        'code',
        'province_id',
        'created_at',
        'updated_at',
    ];
   protected $table='districts';
}
