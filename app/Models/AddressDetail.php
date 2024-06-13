<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressDetail extends Model
{
    use HasFactory;
    protected $fillable = [

        'address',
        'province_id',
        'district_id',
        'ward_id',
        'created_at',
        'updated_at',
    ];
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
