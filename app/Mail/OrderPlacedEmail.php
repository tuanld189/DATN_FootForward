<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

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
                    ->markdown('emails.orders.placed')
                    ->with('orderItems', $orderItems);
    }
}
