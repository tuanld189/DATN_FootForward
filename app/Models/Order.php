<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public const STATUS_ORDER = [
        'pending' => 'Chờ xác nhận',
        'confirmed' => 'Đã xác nhận',
        'preparing_goods' => 'Đang chuẩn bị hàng',
        'shipping' => 'Đang vận chuyển',
        'delivered' => 'Đã giao hàng',
        'canceled' => 'Đơn hàng đã bị hủy',
    ];

    public const STATUS_PAYMENT = [
        'unpaid' => 'Chưa thanh toán',
        'paid' => 'Đã thanh toán',
    ];

    const STATUS_ORDER_PENDING = 'pending';
    const STATUS_ORDER_CONFIRMED = 'confirmed';
    const STATUS_ORDER_PREPARING_GOODS = 'preparing_goods';
    const STATUS_ORDER_SHIPPING = 'shipping';
    const STATUS_ORDER_DELIVERED = 'delivered';
    const STATUS_ORDER_CANCELED = 'canceled';
    const STATUS_PAYMENT_UNPAID = 'unpaid';
    const STATUS_PAYMENT_PAID = 'paid';

    protected $fillable = [
        'user_id',
        'order_code',
        'user_name',
        'user_email',
        'user_phone',
        'user_address',
        'user_password',
        'user_note',
        'is_ship_user_same_user',
        'ship_user_name',
        'ship_user_email',
        'ship_user_phone',
        'ship_user_address',
        'ship_province_code',
        'ship_district_code',
        'ship_ward_code',
        'ship_user_note',
        'status_order',
        'status_payment',
        'total_price',
        'created_at',
        'updated_at',
        'pending_at',
        'confirmed_at',
        'preparing_goods_at',
        'shipping_at',
        'delivered_at',
        'canceled_at',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->pending_at = $order->created_at;
        });
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price', 'color', 'size', 'quantity');
    }
<<<<<<< HEAD
    public function province()
{
    return $this->belongsTo(Province::class, 'province_code', 'code');
}

public function district()
{
    return $this->belongsTo(District::class, 'district_code', 'code');
}

public function ward()
{
    return $this->belongsTo(Ward::class, 'ward_code', 'code');
}
=======

>>>>>>> 424671d218f8fc7818d40c6cd1ad61480217249d
}
