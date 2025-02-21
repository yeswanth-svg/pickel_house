@extends('layouts.app')
@section('title', 'Shipping')
@section('content')
    <div class="container py-5">
        <ol class="breadcrumb justify-content-start mb-3 mt-2 fs-3">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.cart') }}">Cart</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('checkout') }}">Information</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
        <div class="row">
            <!-- Left Section: Shipping Details -->
            <div class="left-panel col-md-7">
                <h2 class="mb-4">Shipping method</h2>
                <div class="card p-4 mb-4">
                    <h5>Contact</h5>
                    <p>{{ auth()->user()->email }}</p>
                    <hr>
                    <h5>Ship to</h5>
                    @php
                        $selectedAddress = json_decode($cartItems->first()->selected_address ?? '{}', true);
                    @endphp

                    <p>
                        {{ $selectedAddress['address'] ?? 'No address provided' }},
                        {{ $selectedAddress['zip_code'] ?? '' }},
                        {{ $selectedAddress['phone'] ?? '' }}
                        <a href="{{route('checkout.process')}}">Change</a>
                    </p>

                </div>
                @php
                    // Get the type_of_shipping from the first "in_cart" order (assuming all have the same type)
                    $selectedShipping = $cartItems->first() ? $cartItems->first()->type_of_shipping : 'priority_shipping';
                @endphp


                <div class="card p-4">
                    <h5>Shipping method</h5>
                    <form id="shipping-form">
                        <div class="form-check border p-3 rounded mb-2">
                            <input class="form-check-input" type="radio" name="shipping" id="priority"
                                value="priority_shipping" {{ $selectedShipping == 'priority_shipping' ? 'checked' : '' }}>
                            <label class="form-check-label d-flex justify-content-between w-100" for="priority">
                                <span>3-5 Business day Priority Shipping (FedEx / DHL)</span>
                                <strong>{{ convertPrice($priorityShipping) }}</strong>
                            </label>
                        </div>
                        <div class="form-check border p-3 rounded">
                            <input class="form-check-input" type="radio" name="shipping" id="standard"
                                value="standard_shipping" {{ $selectedShipping == 'standard_shipping' ? 'checked' : '' }}>
                            <label class="form-check-label d-flex justify-content-between w-100" for="standard">
                                <span>15-20 Business day Standard Shipping</span>
                                <strong>{{ convertPrice($standardShipping) }}</strong>
                            </label>
                        </div>
                    </form>
                </div>


                <div class="text-end mb-3">
                    <button id="continue-payment" class="btn btn-primary mt-4">Continue to payment</button>
                </div>

            </div>

            <!-- Right Section: Order Summary -->
            <div class="right-panel col-12 col-lg-4">
                <div class="card p-3">
                    @foreach ($cartItems as $item)
                        <div class="d-flex align-items-center justify-content-between mb-3 p-2 border rounded"
                            style="gap: 12px; background: #fff;">

                            <!-- Dish Image -->
                            <img src="{{ asset('dish_images/' . $item->dish->image) }}" width="80" height="80" class="rounded"
                                style="object-fit: cover;">

                            <!-- Dish Details -->
                            <div class="flex-grow-1">
                                <p class="mb-1 fw-bold text-dark">{{ $item->dish->name }}</p>
                                <p class="mb-0 fw-bold text-success" style="font-size: 0.85rem;">
                                    {{ $item->quantity->weight }} | Qty: {{ $item->cart_quantity }}
                                </p>
                            </div>

                            <!-- Pricing Section -->
                            <div class="text-end">
                                <p class="mb-0 fw-bold text-dark">{{ convertPrice($item->quantity->discount_price) }}</p>
                                <p class="mb-0 text-decoration-line-through text-primary" style="font-size: 0.9rem;">
                                    {{ convertPrice($item->quantity->original_price) }}
                                </p>
                            </div>

                        </div>
                    @endforeach




                    @php
                        // Get the type_of_shipping from the first "in_cart" order
                        $selectedShipping = $cartItems->first() ? $cartItems->first()->type_of_shipping : 'priority_shipping';
                        $shippingCost = $selectedShipping == 'priority_shipping' ? $priorityShipping : $standardShipping;
                        $grandTotalWithShipping = $grandTotal + $shippingCost;

                        $convertedAmount = PaymentPrice($grandTotal + $shippingCost, true); // Now only once

                    @endphp

                    <div class="mt-3">
                        <div class="d-flex justify-content-between mt-2 mb-3">
                            <span class="text-dark fw-bold">Subtotal (Original Price)</span>
                            <span class="text-dark fw-bold">{{ convertPrice($subtotal) }}</span>
                        </div>
                        <div class="d-flex justify-content-between text-danger fw-bold mt-2 mb-3">
                            <span class="text-dark fw-bold">Your Savings</span>
                            <span class="savings">- {{ convertPrice($savings) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2 mb-3">
                            <span class="text-dark fw-bold">Total</span>
                            <span class="text-dark fw-bold">{{ convertPrice($discountedtotal) }}</span>
                        </div>
                        @if($discountAmount > 0)
                            <div class="d-flex justify-content-between text-danger fw-bold mt-2 mb-3">
                                <span class="text-dark fw-bold">Coupon Discount</span>
                                <span class="savings">- {{ convertPrice($discountAmount) }}</span>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between mt-2 mb-3">
                            <span class="text-dark fw-bold">Shipping</span>
                            <span id="shipping-cost" class="text-dark fw-bold adding">
                                + {{ $shippingCost == 0 ? 'FREE' : convertPrice($shippingCost) }}
                            </span>
                        </div>
                        <hr>



                        <div class="d-flex justify-content-between fw-bold fs-4 mt-2 mb-3">
                            <span class="text-dark fw-bold">Grand Total</span>
                            <span class="jsGrandTotal text-dark fw-bold" id="total-amount">
                                {{ convertPrice($grandTotalWithShipping) }}
                            </span>
                        </div>
                    </div>



                    <!-- Checkout Benefits -->
                    <div class="mt-3">
                        <p><i class="fas fa-truck"></i> <strong>FAST SHIPPING</strong><br>Fast shipping across 30 countries
                        </p>
                        <p><i class="fas fa-lock"></i> <strong>SAFE CHECKOUT</strong><br>Our customer happiness team is
                            available 24/7</p>
                        <p><i class="fas fa-headset"></i> <strong>CUSTOMER SUPPORT</strong><br>24/7 assistance</p>
                        <p><i class="fas fa-globe"></i> <strong>NO CUSTOM DUTIES</strong><br>Enjoy no custom duties across
                            any country</p>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <script>
        document.querySelectorAll('input[name="shipping"]').forEach(input => {
            input.addEventListener('change', function () {
                let selectedShipping = this.value;
                let shippingCost = selectedShipping === "priority_shipping" ? {{ $priorityShipping }} : {{ $standardShipping }};

                fetch("{{ route('update-shipping-method') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        shipping_method: selectedShipping,
                        shipping_cost: shippingCost // Send cost along with method
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            $.notify({
                                message: data.message,
                                title: "Success",
                                icon: "fa fa-check"
                            }, {
                                type: "success"
                            });

                            // Refresh the page after a short delay
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        } else {
                            $.notify({
                                message: data.message,
                                title: "Error",
                                icon: "fa fa-times"
                            }, {
                                type: "danger"
                            });
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    </script>


    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById("continue-payment").addEventListener("click", function () {
            fetch("{{ route('razorpay.initiate') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    grandTotal: "{{ $grandTotalWithShipping }}",
                    amount: "{{ $convertedAmount }}", // Directly using the converted amount
                    currency: "{{ auth()->user()->country }}", // Ensure correct currency is sent
                    name: "{{ auth()->user()->name }}",
                    email: "{{ auth()->user()->email }}",
                    phone: "{{ auth()->user()->phone_number }}"
                })
            })
                .then(response => response.json())
                .then(data => {
                    let options = {
                        "key": data.key,
                        "amount": data.amount,
                        "currency": data.currency,
                        "name": "{{ config('app.name') }}",
                        "description": "Order Payment",
                        "image": "{{ asset('img/logo1.png') }}",
                        "order_id": data.order_id,
                        "handler": function (response) {
                            window.location.href = "{{ route('razorpay.success') }}?payment_id=" + response.razorpay_payment_id;
                        },
                        "prefill": {
                            "name": data.name,
                            "email": data.email,
                            "contact": data.phone
                        },
                        "theme": {
                            "color": "#3399cc"
                        }
                    };
                    let rzp1 = new Razorpay(options);
                    rzp1.open();
                })
                .catch(error => console.error("Error initiating payment:", error));
        });

    </script>
@endsection