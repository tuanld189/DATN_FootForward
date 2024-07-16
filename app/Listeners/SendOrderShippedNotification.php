<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use App\Mail\OrderPlacedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderShippedNotification implements ShouldQueue
{
    public function handle(OrderShipped $event)
    {
        Mail::to($event->order->user_email)->send(new OrderPlacedEmail($event->order));
    }
}
