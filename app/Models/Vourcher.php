<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Log;

class Vourcher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'discount_type', 'discount_value', 'description',
        'start_date', 'end_date', 'is_active', 'quantity'
    ];

    // protected $fillable = ['code', 'description', 'discount_type', 'discount_value', 'start_date', 'end_date', 'is_active', 'quantity'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_voucher');
    }

    // public function canBeRedeemed()
    // {
    //     return $this->is_active && $this->quantity > 0 && Carbon::now()->between($this->start_date, $this->end_date);
    // }

    // public function redeem()
    // {
    //     if ($this->quantity > 0) {
    //         $this->quantity--;
    //         $this->save();
    //     }
    // }

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

    // Kiểm tra xem voucher có thể được sử dụng không
    // public function canBeRedeemed()
    // {
    //     return $this->is_active && $this->quantity > 0 &&
    //         Carbon::now()->between($this->start_date, $this->end_date);
    // }

    // public function redeem()
    // {
    //     if ($this->quantity > 0) {
    //         // Giảm số lượng voucher còn lại
    //         $this->decrement('quantity');

    //         // Nếu số lượng còn lại bằng 0, chuyển trạng thái voucher sang không hoạt động
    //         if ($this->quantity == 0) {
    //             $this->is_active = false;
    //             $this->save();
    //         }
    //     }
    // }

    public function canBeRedeemed()
    {
        return $this->is_active && $this->quantity > 0 &&
            Carbon::now()->between($this->start_date, $this->end_date);
    }

    // Method to redeem the voucher
    public function redeem()
    {
        if ($this->canBeRedeemed()) {
            $this->decrement('quantity');

            // Deactivate voucher if quantity reaches zero
            if ($this->quantity <= 0) {
                $this->is_active = false;
                $this->save();
            }
        }
    }
}
