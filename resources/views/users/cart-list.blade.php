@extends('users.layout.inheritance')

@section('style-list')
<style>
    .cart-table {
        width: 100%;
        table-layout: fixed;
    }

    .cart-table th,
    .cart-table td {
        text-align: center;
        vertical-align: middle;
        padding: 10px;
        border-bottom: 1px solid #dee2e6;
    }

    .cart-table th {
        font-weight: bold;
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }

    .cart-table th:nth-child(1),
    .cart-table td:nth-child(1) {
        width: 25%;
    }

    .cart-table th:nth-child(5),
    .cart-table td:nth-child(5) {
        width: 15%;
    }

    .media {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .media img {
        margin-right: 10px;
    }

    .product_count {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product_count input.qty {
        width: 50px;
        text-align: center;
        border: 1px solid #ddd;
        height: 30px;
        margin: 0 5px;
    }

    .product_count button {
        background: #007bff;
        border: none;
        height: 30px;
        width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: white;
        font-size: 18px;
        line-height: 1;
    }

    .product_count button:hover {
        background: #0056b3;
    }
    .product_count input.manual-qty {
        width: 50px;
        text-align: center;
        border: 1px solid #ddd;
        height: 30px;
        margin: 0 5px;
        background-color: white; /* Ensure background is visible */
        pointer-events: auto; /* Enable pointer events */
    }
    .remove-btn {
        background: #ff4d4d;
        border: none;
        color: white;
        border-radius: 7em;
        padding: 9px 15px;
        cursor: pointer;
    }

    .remove-btn:hover {
        background: #ff1a1a;
    }

    .checkout-buttons {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .checkout-buttons a {
        margin-left: 10px;
        padding: 10px 20px;
        text-decoration: none;
        color: white;
        border: none;
        cursor: pointer;
        display: inline-block;
    }

    .checkout-buttons .continue-shopping-btn {
        background: #007bff;
        color: white;
    }

    .checkout-buttons .continue-shopping-btn:hover {
        background: #0056b3;
    }

    .checkout-buttons .checkout-btn {
        background: #28a745;
        color: white;
    }

    .checkout-buttons .checkout-btn:hover {
        background: #218838;
    }

    .totalAmount {
        text-align: right;
        margin-top: 20px;
        font-size: 18px;
    }

    .totalAmount p {
        margin: 0;
    }
    .update-cart-btn {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .update-cart-btn:hover {
        background-color: #218838;
    }
</style>
@endsection

@section('content')
<section class="cart_area mt-5">
    <div class="container">
        <div class="product_detail_row">
            <h3 class="product_detail_title">SHOPPING CART</h3>
        </div>
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table cart-table">
                    <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Color</th>
                            <th scope="col">Size</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalAmount = 0; @endphp
                        @forelse(session('cart', []) as $item)
                            @php
                                $itemTotal = $item['quantity_add'] * ($item['price'] ?: $item['price_sale']);
                                $totalAmount += $itemTotal;
                            @endphp
                            <tr>
                                <td>
                                    <div class="media">
                                        <img src="{{ asset('storage/'.$item['image']) }}" alt="" width="70px">
                                        <div class="media-body">
                                            <h5>{{ $item['name'] }}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>{{ $item['price'] ?: $item['price_sale'] }} $</h5>
                                </td>
                                <td>
                                    <h5>{{ $item['color']['name'] }}</h5>
                                </td>
                                <td>
                                    <h5>{{ $item['size']['name'] }}</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <input type="number" name="qty" id="sst-{{ $item['id'] }}" value="{{ $item['quantity_add'] }}" title="Quantity:" class="input-text qty" min="1">
                                    </div>
                                </td>
                                <td>
                                    <h5 id="total-{{ $item['id'] }}" data-price="{{ $item['price'] ?: $item['price_sale'] }}">{{ number_format($itemTotal, 2) }} $</h5>
                                </td>
                                <td>
                                    <form action="{{ route('users.cart.remove', ['id' => $item['id']]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="remove-btn"><i class="fa fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No items in the cart</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="totalAmount">
                <p>totalAmount: <b> $ <span id="totalAmount">{{ number_format($totalAmount, 2) }} </b></span></p>
                <p><i>Shipping & taxes calculated at checkout</i></p>
            </div>
            <div class="checkout-buttons">
                <button type="button" onclick="updateCart()" class="update-cart-btn">Update Cart</button>
                <a href="{{ route('users.home') }}" class="primary-btn">Continue Shopping</a>
                <a href="{{ route('users.cart.checkout') }}" class="primary-btn">Proceed to Checkout</a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
  function updateCart() {
    var cartItems = [];

    // Select all rows in the cart table
    var cartRows = document.querySelectorAll('tbody tr');

    cartRows.forEach(function(row) {
        var id = row.querySelector('input.qty').getAttribute('id').replace('sst-', '');
        var quantity = parseInt(row.querySelector('input.qty').value);

        // Push each item with its updated quantity to the cartItems array
        cartItems.push({ id: id, quantity_add: quantity }); // Ensure the key matches what the backend expects
    });

    // Send a fetch request to update multiple items in the cart
    fetch('{{ route("users.cart.update-multiple") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ updated_cart: cartItems })
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        }
        throw new Error('Network response was not ok.');
    })
    .then(data => {
        // Handle successful response
        console.log(data); // Log or handle as needed
        updatetotalAmount(); // Update totalAmount if needed
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

    function updatetotalAmount() {
        // Function to update totalAmount in UI if needed
        // Example implementation, adjust as per your UI requirements
        var totalAmounts = document.querySelectorAll('td[id^="total-"]');
        var totalAmount = 0;
        totalAmounts.forEach(function (element) {
            totalAmount += parseFloat(element.innerText.split(' ')[0]);
        });
        document.getElementById('totalAmount').innerText = totalAmount.toFixed(2);
    }
</script>
@endsection
