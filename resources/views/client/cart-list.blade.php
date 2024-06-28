@extends('client.layout.inheritance')

@section('content')
    <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->


    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#" class="cart-table">
                        <div class="table-content table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="plantmore-product-thumbnail">Images</th>
                                        <th class="cart-product-name">Name</th>
                                        <th class="cart-product-color">Color</th>
                                        <th class="cart-product-size">Size</th>
                                        <th class="plantmore-product-price">Unit Price</th>
                                        <th class="plantmore-product-quantity">Quantity</th>
                                        <th class="plantmore-product-subtotal">Total</th>
                                        <th class="plantmore-product-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $totalAmount = 0; @endphp
                                    @forelse(session('cart', []) as $item)
                                        @php
                                            $itemTotal =
                                                $item['quantity_add'] * ($item['price'] ?: $item['price_sale']);
                                            $totalAmount += $itemTotal;
                                        @endphp
                                        <tr>
                                            <td class="plantmore-product-thumbnail">
                                                <a href="#">
                                                    <img src="{{ asset('storage/' . $item['image']) }}" alt=""
                                                        width="70px">
                                                </a>
                                            </td>
                                            <td class="plantmore-product-name"><a href="#">{{ $item['name'] }}</a>
                                            </td>
                                            <td class="plantmore-product-color">{{ $item['color']['name'] }}</td>
                                            <td class="plantmore-product-size">{{ $item['size']['name'] }}</td>
                                            <td class="plantmore-product-price"><span
                                                    class="amount">${{ $item['price'] ?: $item['price_sale'] }}</span></td>


                                            <td class="plantmore-product-quantity product_count">
                                                <form action="{{ route('cart.update', ['id' => $item['id']]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="number" name="quantity_add" id="sst-{{ $item['id'] }}"
                                                        value="{{ $item['quantity_add'] }}" title="Quantity:"
                                                        class="input-text qty" min="1" onchange="this.form.submit()">
                                                </form>
                                            </td>
                                            <td class="product-subtotal"><span id="total-{{ $item['id'] }}"
                                                    data-price="{{ $item['price'] ?: $item['price_sale'] }}">
                                                    {{ number_format($itemTotal, 2) }} $
                                                </span></td>
                                            <td class="plantmore-product-remove">
                                                <form action="{{ route('cart.remove', ['id' => $item['id']]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="remove-btn"
                                                        onclick="alert('Chắc chắn xóa?')"><i
                                                            class="fa fa-times"></i></button>
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
                        <div class="row">
                            <div class="col-md-8">
                                <div class="coupon-all">

                                    <div class="coupon2">
                                        {{-- <input class="submit btn" name="update_cart" value="Update cart" type="submit"> --}}
                                        <a href="{{ route('index') }}" class="btn continue-btn">Continue Shopping</a>
                                    </div>

                                    <div class="coupon">
                                        <h3>Coupon</h3>
                                        <p>Enter your coupon code if you have one.</p>
                                        <input id="coupon_code" class="input-text" name="coupon_code" value=""
                                            placeholder="Coupon code" type="text">
                                        <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Cart totals</h2>
                                    <ul>
                                        {{-- <li>Subtotal <span>$170.00</span></li> --}}
                                        <li>Total <span>${{ number_format($totalAmount, 2) }}</span></li>
                                    </ul>
                                    <a href="{{ route('cart.checkout') }}" class="proceed-checkout-btn">Proceed to checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
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
      fetch('{{ route("cart.update-multiple") }}', {
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
          if (data.success) {
              alert('Cart updated successfully!');
              updatetotalAmount(); // Update totalAmount if needed
          } else {
              alert('Failed to update cart.');
          }
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
