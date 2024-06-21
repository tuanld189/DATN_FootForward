<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vourcher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'discount_type', 'discount_value', 'description',
        'start_date', 'end_date', 'is_active', 'quantity'
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'discount_value' => 'integer',
    ];

    // Accessor to check if the vourcher is expired
    public function getIsExpiredAttribute()
    {
        return Carbon::now()->isAfter($this->end_date);
    }

    public function canBeRedeemed()
    {
        return $this->is_active && $this->quantity > 0;
    }

    public function redeem()
    {
        if ($this->canBeRedeemed()) {
            $this->decrement('quantity');
        }
    }

    //
    public function getFormattedDiscountAttribute()
    {
        if ($this->discount_type === 'percentage') {
            return $this->discount_value . '%';
        } elseif ($this->discount_type === 'amount') {
            return '$' . number_format($this->discount_value, 2);
        } else {
            return 'N/A';
        }
    }
}
