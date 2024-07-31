<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Order;
use Carbon\Carbon;

class OrderUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    private $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Cập nhật đơn hàng')
            ->greeting('FootForward xin chào!')
            ->line('Đơn hàng của bạn đã được cập nhật.')
            ->line('Mã đơn hàng: ' . $this->order->order_code)
            ->line('Trạng thái hiện tại: ' . Order::STATUS_ORDER[$this->order->status_order])
            ->line('Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!')
            ->salutation('Trân trọng, FootForward Shoes.');
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'order_code' => $this->order->order_code,
            'status_order' => $this->order->status_order,
            'status_time' => $this->getStatusTime($this->order->status_order),
        ];
    }

    private function getStatusTime($status)
    {
        switch ($status) {
            case Order::STATUS_ORDER_PENDING:
                return $this->order->pending_at ? Carbon::parse($this->order->pending_at) : null;
            case Order::STATUS_ORDER_CONFIRMED:
                return $this->order->confirmed_at ? Carbon::parse($this->order->confirmed_at) : null;
            case Order::STATUS_ORDER_PREPARING_GOODS:
                return $this->order->preparing_goods_at ? Carbon::parse($this->order->preparing_goods_at) : null;
            case Order::STATUS_ORDER_SHIPPING:
                return $this->order->shipping_at ? Carbon::parse($this->order->shipping_at) : null;
            case Order::STATUS_ORDER_DELIVERED:
                return $this->order->delivered_at ? Carbon::parse($this->order->delivered_at) : null;
            case Order::STATUS_ORDER_CANCELED:
                return $this->order->canceled_at ? Carbon::parse($this->order->canceled_at) : null;
            default:
                return null;
        }
    }
}
