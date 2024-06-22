@extends('layouts.template')

@section('title')
    Cart
@endsection

@section('content')
    <style>
        .radio-wrapper {
            position: relative;
            width: fit-content;
            height: fit-content;
            display: inline-block;
            width: 15px;
            height: 15px;
            margin-left: 10px;
        }

        .radio-wrapper::after {
            content: '';
            pointer-events: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: #ffba00 2px solid;
            border-radius: 50%;
            background-repeat: no-repeat;
            background-position: center center;
        }

        .radio-wrapper:has(input:checked)::after {
            background-image: radial-gradient(#ffba00 0 50%, transparent 10% 80%);
        }

        .radio-wrapper input {
            opacity: 0;
        }

        .radio-wrapper .radio {
            width: 40px !important;
            height: 60px !important;
            margin-bottom: 0px !important;
            margin-top: 0 !important;
        }
    </style>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('home') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('cart') }}">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->


    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive" style="overflow-x: hidden">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $orderItem)
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="data:image/jpeg;base64,{{ stream_get_contents($orderItem->product->image) }}"
                                                    alt=""
                                                    style="width: 120px; max-width: 120px; height: 120px; max-height: 120px">
                                            </div>
                                            <div class="media-body">
                                                <p>{{ $orderItem->product->nama }}</p>
                                                <div>Stok: {{ $orderItem->product->stok }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="hidden" id="harga_{{ $orderItem->id }}"
                                            value="{{ $orderItem->harga }}">
                                        <h5>Rp. {{ number_format($orderItem->harga, 0, '.', '.') }}</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <input type="number" name="qty" id="qty_{{ $orderItem->id }}"
                                                maxlength="12" title="Quantity:" class="input-text qty"
                                                value="{{ $orderItem->jumlah }}"
                                                onchange="updateQuantityOnChange({{ $orderItem->id }})">
                                            <button onclick="increaseQuantity({{ $orderItem->id }})"
                                                class="increase items-count" type="button"><i
                                                    class="lnr lnr-chevron-up"></i></button>
                                            <button onclick="decreaseQuantity({{ $orderItem->id }})"
                                                class="reduced items-count" type="button"><i
                                                    class="lnr lnr-chevron-down"></i></button>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: flex; justify-content: space-between">
                                            <h5 id="total_price_{{ $orderItem->id }}">Rp.
                                                {{ number_format($orderItem->jumlah * $orderItem->harga, 0, '.', '.') }}
                                            </h5>
                                            <a href="{{ route('cart.remove_item', $orderItem->id) }}" class="lnr lnr-cross"
                                                title="Remove Product"
                                                onclick="return confirm('Are you sure you want to remove this product?')"></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5 id="subtotal">Rp. 0</h5>
                                </td>
                            </tr>
                            @if ($order->orderItems->count() > 0)
                                <tr class="shipping_area">
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <h5>Pengiriman</h5>
                                    </td>

                                    <td>
                                        <div class="shipping_box">
                                            <ul class="list">
                                                <li>
                                                    <div style="display: flex; justify-content: right; align-items: center">
                                                        Ambil di Toko
                                                        <div class="radio-wrapper"><input type="radio" class="radio"
                                                                name="shipping_option" value="1"
                                                                {{ $order->jenis_pengiriman != 2 ? 'checked' : '' }}>
                                                        </div>
                                                    </div>

                                                </li>
                                                <li>
                                                    <div style="display: flex; justify-content: right; align-items: center">
                                                        Antar ke Rumah
                                                        <div class="radio-wrapper"><input type="radio" class="radio"
                                                                name="shipping_option" value="2"
                                                                {{ $order->jenis_pengiriman == 2 ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                            @endif
                            <tr class="out_button_area">
                                <td colspan="4">
                                    <div class="checkout_btn_inner d-flex align-items-center"
                                        style="margin-left: 0px; justify-content: right">
                                        <a class="gray_btn" href="{{ route('products') }}">Lanjut Belanja</a>
                                        @if ($order->orderItems->count() > 0)
                                            <a class="primary-btn" href="{{ route('cart.checkout') }}">Checkout Produk</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            updateSubtotal();
        });

        document.addEventListener('DOMContentLoaded', function() {
            var radios = document.querySelectorAll('input[name="shipping_option"]');

            radios.forEach(function(radio) {
                radio.addEventListener('change', function(event) {
                    var shippingOption = event.target.value;

                    // Prepare data to send via AJAX
                    var data = new FormData();
                    data.append('shipping_option', shippingOption);
                    data.append('_token', '{{ csrf_token() }}'); // Replace with your CSRF token

                    // Create a new XMLHttpRequest object
                    var xhr = new XMLHttpRequest();

                    // Configure it: POST-request for the URL
                    xhr.open('POST',
                        '{{ route('cart.shipping') }}'); // Replace with your Laravel route

                    // Setup callback function for successful request
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            console.log(xhr
                                .responseText); // Log success message or handle response
                        } else {
                            console.error('Request failed. Status:', xhr.status);
                        }
                    };

                    // Setup callback function for error
                    xhr.onerror = function() {
                        console.error('Request failed. Check your network connection.');
                    };

                    // Send request with the data
                    xhr.send(data);
                });
            });
        });

        function updateSubtotal() {
            var subtotal = 0;
            @foreach ($order->orderItems as $orderItem)
                var pricePerItem{{ $orderItem->id }} = {{ $orderItem->harga }};
                var quantity{{ $orderItem->id }} = document.getElementById('qty_{{ $orderItem->id }}').value;
                var total{{ $orderItem->id }} = pricePerItem{{ $orderItem->id }} * parseInt(
                    quantity{{ $orderItem->id }});
                subtotal += total{{ $orderItem->id }};
            @endforeach

            var subtotalElement = document.getElementById('subtotal');
            subtotalElement.textContent = 'Rp. ' + subtotal.toLocaleString('id-ID');
        }

        function increaseQuantity(orderItemId) {
            var quantityInput = document.getElementById('qty_' + orderItemId);
            var currentValue = parseInt(quantityInput.value);
            if (!isNaN(currentValue)) {
                quantityInput.value = currentValue + 1;
                updateQuantity(orderItemId, quantityInput.value);
            }
        }

        function decreaseQuantity(orderItemId) {
            var quantityInput = document.getElementById('qty_' + orderItemId);
            var currentValue = parseInt(quantityInput.value);
            if (!isNaN(currentValue) && currentValue > 1) {
                quantityInput.value = currentValue - 1;
                updateQuantity(orderItemId, quantityInput.value);
            }
        }

        function updateQuantityOnChange(orderItemId) {
            var quantityInput = document.getElementById('qty_' + orderItemId);
            var newQuantity = parseInt(quantityInput.value);
            if (!isNaN(newQuantity) && newQuantity >= 1) {
                updateQuantity(orderItemId, newQuantity);
            } else {
                // Reset the input value or handle invalid input
                if (!isNaN(newQuantity)) {
                    newQuantity = 1;
                }
                quantityInput.value = newQuantity;
                updateQuantity(orderItemId, newQuantity);
            }
        }

        function updateQuantity(orderItemId, newQuantity) {
            // Send an AJAX request to update the quantity in the backend
            fetch('{{ route('cart.update_quantity') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        orderItemId: orderItemId,
                        quantity: newQuantity
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to update quantity');
                    }
                    // Optionally handle success or update UI
                    updateTotalPrice(orderItemId, newQuantity);
                })
                .catch(error => {
                    console.error('Error updating quantity:', error);
                    // Handle error or revert quantity change
                });
        }

        function updateTotalPrice(orderItemId, newQuantity) {
            // Update the displayed total price for the order item
            var totalPriceElement = document.getElementById('total_price_' + orderItemId);
            var pricePerItem = document.getElementById('harga_' + orderItemId);
            totalPriceElement.textContent = 'Rp. ' + (pricePerItem.value * newQuantity).toLocaleString('id-ID');

            updateSubtotal();
        }
    </script>
    <!--================End Cart Area =================-->
@endsection
