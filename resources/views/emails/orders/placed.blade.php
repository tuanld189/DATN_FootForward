@component('mail::message')
<div style="text-align: center; font-size: 24px; font-weight: bold; margin-bottom: 10px; color: black;">
    Xác Nhận Đặt Hàng Thành Công
</div>

<div style="text-align: center; margin-bottom: 20px;">
    <img src="{{ $logo }}" alt="FootForward Logo" width="130" height="130">
</div>

<p style="color: black;">Xin chào <strong>{{ $order->user_name }}</strong>,</p>

<p style="color: black;">Cảm ơn bạn đã đặt hàng tại FootForward. Đây là thông tin đơn hàng của bạn:</p>

<p style="color: black;"><strong>Mã đơn hàng:</strong> {{ $order->order_code }}</p>

<table class="table" style="width: 100%; border-collapse: collapse; text-align: center; margin-bottom: 10px; color: black;">
    <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 8px;">Tên sản phẩm</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Giá</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Số lượng</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Màu</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Tổng</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orderItems as $item)
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item->product_name }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">
                    @if ($item->product_sale_price)
                        <del>{{ number_format($item->product_price, 0, ',', '.') }} ₫</del><br>
                        {{ number_format($item->product_sale_price, 0, ',', '.') }} ₫
                    @else
                        {{ number_format($item->product_price, 0, ',', '.') }} ₫
                    @endif
                </td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item->quantity_add }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item->variant_color_name }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">
                    @if ($item->product_sale_price)
                        <del>{{ number_format($item->product_price * $item->quantity_add, 0, ',', '.') }} ₫</del><br>
                        {{ number_format($item->product_sale_price * $item->quantity_add, 0, ',', '.') }} ₫
                    @else
                        {{ number_format($item->product_price * $item->quantity_add, 0, ',', '.') }} ₫
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<p style="color: black;"><strong>Tình trạng thanh toán:</strong> {{ \App\Models\Order::STATUS_PAYMENT[$order->status_payment] }}</p>

<p style="color: black;"><strong>Tình trạng đơn hàng:</strong> {{ \App\Models\Order::STATUS_ORDER[$order->status_order] }}</p>

<p style="color: black;"><strong>Số điện thoại:</strong> {{ $order->user_phone }}</p>

<p style="color: black;"><strong>Địa điểm nhận hàng:</strong> {{ $order->user_address }}</p>

@if($order->user_note)
<p style="color: black;"><strong>Note:</strong> {{ $order->user_note }}</p>
@endif

<p style="color: black;"><strong>Tổng cộng:</strong> {{ number_format($order->total_price, 0, ',', '.') }} ₫</p>

@if($order->user_password)
<p style="color: black;">Để theo dõi đơn hàng, bạn có thể đăng nhập với thông tin sau:</p>

<table width="100%" cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; text-align: left; color: black;">
    <tr>
        <td style="font-weight: bold;">Tài khoản email đăng nhập:</td>
        <td>{{ $order->user_email }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold;">Mật khẩu:</td>
        <td>{{ $order->user_password }}</td>
    </tr>
</table>
@endif

<p style="color: black; margin-top:20px; ">Cảm ơn bạn đã mua sắm cùng chúng tôi!</p>

<p style="color: black;">Trân trọng,<br>FootForward Shoes!</p>
@endcomponent
