@extends('admin.layout.master')
@section('title')
    Create Order
@endsection
@section('content')
    <div class="container">
        <h1>Create Order</h1>
        <form action="{{ route('admin.orders.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">User Name:</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" data-email="{{ $user->email }}" data-phone="{{ $user->phone }}" data-address="{{ $user->address }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="user_email">User Email:</label>
                <input type="email" name="user_email" id="user_email" class="form-control" readonly required>
            </div>
            <div class="form-group">
                <label for="user_phone">User Phone:</label>
                <input type="text" name="user_phone" id="user_phone" class="form-control" readonly required>
            </div>
            <div class="form-group">
                <label for="user_address">User Address:</label>
                <input type="text" name="user_address" id="user_address" class="form-control" readonly required>
            </div>
            <h2>Order Items</h2>
            <div id="order-items">
                <div class="order-item">
                    <div class="form-group">
                        <label for="product_id_0">Product:</label>
                        <select name="order_items[0][product_id]" id="product_id_0" class="form-control product-select"
                            required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-product='@json($product)'>
                                    {{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_name_0">Product Name:</label>
                        <input type="text" name="order_items[0][product_name]" id="product_name_0" class="form-control"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="product_sku_0">Product SKU:</label>
                        <input type="text" name="order_items[0][product_sku]" id="product_sku_0" class="form-control"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="product_price_0">Product Price:</label>
                        <input type="text" name="order_items[0][product_price]" id="product_price_0" class="form-control"
                            readonly>
                    </div>
                    {{-- <div class="form-group">
                        <label for="product_image_0">Product Image:</label>
                        <img id="product_image_0" class="product-image" src="" alt="Product Image" style="max-width: 100px;">
                    </div> --}}
                    <div class="form-group">
                        <label for="quantity_0">Quantity:</label>
                        <input type="number" name="order_items[0][quantity]" id="quantity_0" class="form-control" required>
                    </div>
                    <!-- Các trường khác tương tự -->
                </div>
            </div>
            <button type="button" id="add-item">Add Item</button>
            <button type="submit" class="btn btn-primary">Create Order</button>
        </form>
    </div>

    <script>
        document.getElementById('add-item').addEventListener('click', function() {
            var orderItems = document.getElementById('order-items');
            var index = orderItems.children.length; // Counting the number of order items
            var item = `
            <div class="order-item">
                <div class="form-group">
                    <label for="product_id_${index}">Product:</label>
                    <select name="order_items[${index}][product_id]" id="product_id_${index}" class="form-control product-select" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" data-product='@json($product)'>{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="product_name_${index}">Product Name:</label>
                    <input type="text" name="order_items[${index}][product_name]" id="product_name_${index}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="product_sku_${index}">Product SKU:</label>
                    <input type="text" name="order_items[${index}][product_sku]" id="product_sku_${index}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="product_price_${index}">Product Price:</label>
                    <input type="text" name="order_items[${index}][product_price]" id="product_price_${index}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="product_image_${index}">Product Image:</label>
                    <img id="product_image_${index}" class="product-image" src="" alt="Product Image" style="max-width: 100px;">
                </div>
                <div class="form-group">
                    <label for="quantity_${index}">Quantity:</label>
                    <input type="number" name="order_items[${index}][quantity]" id="quantity_${index}" class="form-control" required>
                </div>
                <!-- Các trường khác tương tự -->
            </div>
        `;
            orderItems.insertAdjacentHTML('beforeend', item);
        });

        document.addEventListener('change', function(event) {
            if (event.target.classList.contains('product-select')) {
                var selectedProduct = JSON.parse(event.target.selectedOptions[0].getAttribute('data-product'));
                var parent = event.target.closest('.order-item');
                parent.querySelector('[name$="[product_name]"]').value = selectedProduct.name;
                parent.querySelector('[name$="[product_sku]"]').value = selectedProduct.sku;
                parent.querySelector('[name$="[product_price]"]').value = selectedProduct.price;
            }
        });
    </script>
@endsection
