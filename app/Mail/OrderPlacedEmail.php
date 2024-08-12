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

        $logoPath = public_path('assets/images/logo-shoes.png');
        $this->attach($logoPath, [
            'as' => 'logo-shoes.png',
            'mime' => 'image/png',
        ]);

        return $this->subject('Xác nhận đặt hàng thành công từ FootForward')
                    ->markdown('emails.orders.placed')
                    ->with([
                        'logo' => 'cid:logo-shoes.png',
                        'orderItems' => $orderItems
                    ]);
    }
}

