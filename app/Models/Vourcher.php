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

    // protected $fillable = ['code', 'description', 'discount_type', 'discount_value', 'start_date', 'end_date', 'is_active', 'quantity'];

    public function canBeRedeemed()
    {
        return $this->is_active && $this->quantity > 0 && Carbon::now()->between($this->start_date, $this->end_date);
    }

    public function redeem()
    {
        if ($this->quantity > 0) {
            $this->quantity--;
            $this->save();
        }
    }
    protected $dates = [
        'start_date',
        'end_date',
        // 'discount_value' => 'integer',
    ];

    // Accessor to check if the vourcher is expired
    public function getIsExpiredAttribute()
    {
        return Carbon::now()->isAfter($this->end_date);
    }

    // public function canBeRedeemed()
    // {
    //     return $this->is_active && $this->quantity > 0;
    // }

    // public function redeem()
    // {
    //     if ($this->canBeRedeemed()) {
    //         $this->decrement('quantity');
    //     }
    // }

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

    public static function validateVoucher($code)
    {
        $voucher = self::where('code', $code)->first();
        if ($voucher && $voucher->canBeRedeemed()) {
            return $voucher;
        }
        return null;
    }

    // ham nay de kiem tra ngay neu ma het hạn sẽ không dùng dc
    public static function firstWithExpiryDate($code, $userId)
    {
        return static::where('code', $code)
            ->where('is_active', true)
            ->where('quantity', '>', 0)
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->first();
    }

}
