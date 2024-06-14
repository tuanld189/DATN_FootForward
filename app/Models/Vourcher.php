<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vourcher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount',
        'description',
        'start_date',
        'end_date',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    // Accessor to check if the vourcher is expired
    public function getIsExpiredAttribute()
    {
        return Carbon::now()->isAfter($this->end_date);
    }

}
