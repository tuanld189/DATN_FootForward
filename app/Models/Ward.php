<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $fillable=[

        'name',
        'code',
        'district_id',
        'created_at',
        'updated_at',
    ];
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
