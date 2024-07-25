
<div class="row mb-2">
    <div class="col-md-6">
        <p class="text-center"><strong>Thông tin đơn hàng</strong></p>
        <p><strong>Ngày tạo đơn:</strong> <span id="order-date">{{ $order->created_at->format('d M, Y') }}</span></p>
        <p><strong>Trạng thái đơn hàng:</strong> <span id="order-status">{{ \App\Models\Order::STATUS_ORDER[$order->status_order] }}</span></p>
        <p><strong>Trạng thái thanh toán:</strong> <span id="payment-status">{{ \App\Models\Order::STATUS_PAYMENT[$order->status_payment] }}</span></p>
        <p><strong>Tổng tiền:</strong> <span id="total-amount">{{ number_format($order->total_price, 0, ',', '.') }} VND</span></p>
    </div>
    <div class="col-md-6">
        <p class="text-center"><strong>Thông tin Khách hàng</strong></p>
        <p><strong>Khách hàng:</strong> <span id="customer-name">{{ $order->user_name }}</span></p>
        <p><strong>Điện thoại:</strong> <span id="customer-phone">{{ $order->user_phone }}</span></p>
        <p><strong>Địa chỉ:</strong> <span id="customer-address">{{ $order->user_address }}</span></p>
        @if (!empty($order->user_note))
            <p><strong>Ghi chú:</strong> <span id="user-note">{{ $order->user_note }}</span></p>
        @endif
    </div>
</div>
<div class="order-status p-4">
    <h3 class="text-center p-2 mb-4"><strong>Trạng Thái Đơn Hàng</strong></h3>
    <ul class="list-unstyled d-flex justify-content-between align-items-center " >
        @php
            $statuses = [
                'pending' => 'Chờ xác nhận',
                'confirmed' => 'Đã xác nhận',
                'preparing_goods' => 'Đang chuẩn bị hàng',
                'shipping' => 'Đang vận chuyển',
                'delivered' => 'Đã giao hàng',
                'canceled' => 'Đơn hàng đã bị hủy',
            ];
            $currentStatus = $order->status_order; // Trạng thái hiện tại của đơn hàng
        @endphp
        @foreach ($statuses as $key => $label)
            @php
                $isCurrent = $key == $currentStatus;
                $statusClass = $isCurrent ?
                    ($key == 'pending' ? 'bg-warning text-dark' :
                    ($key == 'confirmed' ? 'bg-info text-light' :
                    ($key == 'preparing_goods' ? 'bg-secondary text-light' :
                    ($key == 'shipping' ? 'bg-primary text-light' :
                    ($key == 'delivered' ? 'bg-success text-light' :
                    ($key == 'canceled' ? 'bg-danger text-light' : '')))))) : '';
            @endphp
            <li class="text-center d-flex flex-column align-items-center
                {{ $isCurrent ? '' : 'text-muted' }} {{ $key == 'canceled' ? 'text-danger' : '' }}" style="height:130px;">
                <div class="icon mb-2 p-2 rounded-circle {{ $statusClass }}">
                    <i class="bi
                        {{ $key == 'pending' ? 'bi-hourglass' : '' }}
                        {{ $key == 'confirmed' ? 'bi-check-circle' : '' }}
                        {{ $key == 'preparing_goods' ? 'bi-box' : '' }}
                        {{ $key == 'shipping' ? 'bi-truck' : '' }}
                        {{ $key == 'delivered' ? 'bi-check2-circle' : '' }}
                        {{ $key == 'canceled' ? 'bi-x-circle' : '' }}
                        fs-3"></i>
                </div>
                <div class="status-label mb-2 {{ $isCurrent ? 'fw-bold' : '' }}">
                    {{ $label }}
                </div>
                @if (!empty($order->{$key . '_at'}))
                    <div class="text-muted fs-6">{{ $order->{$key . '_at'} }}</div>
                @endif
            </li>
        @endforeach
    </ul>
</div>
<div class="order-products">
    <p class="text-center"><strong>Chi tiết sản phẩm</strong></p>
    <table class="product-table">
        <thead>
            <tr>
                <th>Tên Sản Phẩm</th>
                <th>Giá</th>
                <th>Màu</th>
                <th>Kích Thước</th>
                <th>Số Lượng</th>
                <th>Thành Tiền</th>
            </tr>
        </thead>
        <tbody id="product-body">
            @foreach ($orderItems as $index => $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>
                        @if(isset($item->product_sale_price))
                        <del> {{ number_format($item->product_price, 0, ',', '.') }} VND </del> <br>
                        <span>{{ number_format($item->product_sale_price , 0, ',', '.') }} VND</span>
                        @else
                            {{ number_format($item->product_price, 0, ',', '.') }} VND
                        @endif
                    </td>
                    <td>{{ $item->variant_color_name }}</td>
                    <td>{{ $item->variant_size_name }}</td>
                    <td>{{ $item->quantity_add }}</td>
                    <td>


                        @if(isset($item->product_sale_price))
                        <del>{{ number_format($item->product_price * $item->quantity_add, 0, ',', '.') }} VND </del> <br>
                        <span>{{ number_format($item->product_sale_price * $item->quantity_add, 0, ',', '.') }} VND</span>
                        @else
                        {{ number_format($item->product_price * $item->quantity_add, 0, ',', '.') }} VND
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
