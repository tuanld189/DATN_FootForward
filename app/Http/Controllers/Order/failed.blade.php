@extends('client.layout.inheritance')

@section('content')
<div class="container">
    <h2>Order Failed</h2>
    <p>Unfortunately, your payment has failed. Please try again.</p>
    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Total Amount:</strong> ${{ number_format($order->total_price, 2) }}</p>
    <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
    <!-- Add more order details as needed -->
</div>
@endsection
