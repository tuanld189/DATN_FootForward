@component('mail::message')
<div style="text-align: center; font-size: 24px; font-weight: bold; margin-bottom:10px;">
    Xác Nhận Đặt Hàng Thành Công
</div>

Xin chào {{ $order->user_name }},

Cảm ơn bạn đã đặt hàng tại FootForward. Đây là thông tin đơn hàng của bạn:

<table class="table" style="width: 100%; border-collapse: collapse; text-align: center; margin-bottom:10px;">
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
                @if($item->product_sale_price)
                    <del>{{ number_format($item->product_price, 0, ',', '.') }} ₫</del><br>
                    {{ number_format($item->product_sale_price, 0, ',', '.') }} ₫
                @else
                    {{ number_format($item->product_price, 0, ',', '.') }} ₫
                @endif
            </td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $item->quantity_add }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $item->variant_color_name }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format(($item->product_sale_price ?: $item->product_price) * $item->quantity_add, 0, ',', '.') }} ₫</td>
        </tr>
        @endforeach
    </tbody>
</table>

**Tổng cộng:** {{ number_format($order->total_price, 0, ',', '.') }} ₫

Cảm ơn bạn đã mua sắm cùng chúng tôi!

Trân trọng,

FootForward Shoes

FootForward Shoes!

@endcomponent
