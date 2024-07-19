<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        $orderItems = $this->order->orderItems;
        
        return $this->subject('Xác nhận đặt thành công từ FootForward')
                    ->markdown('emails.orders.placed') // Sử dụng markdown thay vì view
                    ->with('orderItems', $orderItems); // Truyền dữ liệu vào view
    }
}

