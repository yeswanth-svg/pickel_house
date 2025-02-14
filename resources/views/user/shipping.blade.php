@extends('layouts.app')
@section('title', 'Shipping')
@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Left Section: Shipping Details -->
            <div class="left-panel col-md-7">
                <h2 class="mb-4">Shipping method</h2>
                <div class="card p-4 mb-4">
                    <h5>Contact</h5>
                    <p>{{ auth()->user()->email }} <a href="#">Change</a></p>
                    <hr>
                    <h5>Ship to</h5>
                    @php
                        $selectedAddress = json_decode($cartItems->first()->selected_address ?? '{}', true);
                    @endphp

                    <p>
                        {{ $selectedAddress['address'] ?? 'No address provided' }},
                        {{ $selectedAddress['zip_code'] ?? '' }},
                        {{ $selectedAddress['phone'] ?? '' }}
                        <a href="#">Change</a>
                    </p>

                </div>
                @php
                    // Get the type_of_shipping from the first "in_cart" order (assuming all have the same type)
                    $selectedShipping = $cartItems->first() ? $cartItems->first()->type_of_shipping : 'priority_shipping';

                    // Check if shipping is free (both shipping costs are zero)
                    $isFreeShipping = ($priorityShipping == 0 && $standardShipping == 0);
                @endphp

                @if(!$isFreeShipping)
                    <div class="card p-4">
                        <h5>Shipping method</h5>
                        <form id="shipping-form">
                            <div class="form-check border p-3 rounded mb-2">
                                <input class="form-check-input" type="radio" name="shipping" id="priority"
                                    value="priority_shipping" {{ $selectedShipping == 'priority_shipping' ? 'checked' : '' }}>
                                <label class="form-check-label d-flex justify-content-between w-100" for="priority">
                                    <span>3-5 Business day Priority Shipping (FedEx / DHL)</span>
                                    <strong>${{ number_format($priorityShipping, 2) }}</strong>
                                </label>
                            </div>
                            <div class="form-check border p-3 rounded">
                                <input class="form-check-input" type="radio" name="shipping" id="standard"
                                    value="standard_shipping" {{ $selectedShipping == 'standard_shipping' ? 'checked' : '' }}>
                                <label class="form-check-label d-flex justify-content-between w-100" for="standard">
                                    <span>15-20 Business day Standard Shipping</span>
                                    <strong>${{ number_format($standardShipping, 2) }}</strong>
                                </label>
                            </div>
                        </form>
                    </div>
                @endif

                <button id="continue-payment" class="btn btn-primary mt-4 text-align-left">Continue to payment</button>
            </div>

            <!-- Right Section: Order Summary -->
            <div class="right-panel col-12 col-lg-4">
                <div class="card p-3">
                    <!-- Product Summary -->
                    @foreach ($cartItems as $item)
                        <div class="d-flex justify-content-around align-items-center mb-2">
                            <img src="{{ asset('dish_images/' . $item->dish->image) }}" width="70" class="me-3 rounded">
                            <div>
                                <p class="mb-0 text-dark"><strong>{{ $item->dish->name }}</strong></p>
                                <small class="text-dark">{{ $item->quantity->weight }}</small>
                            </div>
                            <div class="cart__punit hide-mobile">
                                <span class="jsPrice">{{convertPrice($item->quantity->discount_price) }}</span>

                                <span
                                    class="jsPrice d-block text-decoration-line-through text-primary">{{ convertPrice($item->quantity->original_price) }}</span>

                            </div>
                        </div>
                    @endforeach

                    <!-- Discount Code -->
                    <div class="coupon-container d-flex align-items-center justify-content-between mt-3 p-2 border rounded">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-tag"></i> <!-- Coupon Icon -->
                            <span class="fw-bold">Apply Coupons</span>
                        </div>
                        <!-- Button to trigger the modal -->
                        <button class="btn btn-outline-danger px-3" data-bs-toggle="modal" data-bs-target="#couponModal">
                            Coupons
                        </button>
                    </div>
                    <!-- Apply Coupon Modal -->
                    <!-- Apply Coupon Modal -->
                    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="couponModalLabel">Apply Coupon</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Coupon Input Field -->
                                    <div class="input-group mb-3">
                                        <input type="text" id="coupon_code" class="form-control"
                                            placeholder="Enter coupon code">
                                        <button class="btn btn-secondary" onclick="applyCoupon()">Apply</button>
                                    </div>

                                    <!-- Available Coupons -->
                                    <div class="coupon-list">
                                        <h6>Available Coupons:</h6>
                                        @foreach ($availableCoupons as $coupon)
                                            <div
                                                class="coupon-item p-3 border rounded d-flex justify-content-between align-items-center">
                                                <div>
                                                    <span class="badge bg-danger">{{ $coupon->code }}</span>
                                                    <br>
                                                    <!-- Check if the coupon is fixed or percentage -->
                                                    @if ($coupon->type === 'fixed')
                                                        <strong>Save {{ convertPrice($coupon->value) }}</strong>
                                                    @elseif ($coupon->type === 'percentage')
                                                        <strong>Save {{ $coupon->value }}% off</strong>
                                                    @endif
                                                    <br>
                                                    <small>{{ $coupon->description }}</small>
                                                    <br>
                                                    <small>Expires on:
                                                        {{ \Carbon\Carbon::parse($coupon->expiry_date)->format('d M Y | h:i A') }}</small>
                                                </div>
                                                <button class="btn btn-outline-primary btn-sm"
                                                    onclick="copyCoupon('{{ $coupon->code }}')">
                                                    Copy
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <span class="text-muted">Maximum savings: ₹200</span>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>





                    @php
                        // Get the type_of_shipping from the first "in_cart" order
                        $selectedShipping = $cartItems->first() ? $cartItems->first()->type_of_shipping : 'priority_shipping';
                        $shippingCost = $selectedShipping == 'priority_shipping' ? $priorityShipping : $standardShipping;
                        $grandTotalWithShipping = $grandTotal + $shippingCost;
                    @endphp

                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <span>Subtotal (Original Price)</span>
                            <span>{{ convertPrice($subtotal) }}</span>
                        </div>
                        <div class="d-flex justify-content-between text-danger fw-bold">
                            <span>Your Savings</span>
                            <span class="savings">- {{ convertPrice($savings) }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Shipping</span>
                            <span id="shipping-cost">
                                {{ $shippingCost == 0 ? 'FREE' : convertPrice($shippingCost) }}
                            </span>
                        </div>
                        <hr>

                        @if($discountAmount > 0)
                            <div class="d-flex justify-content-between text-danger fw-bold">
                                <span>Coupon Discount</span>
                                <span class="savings">- {{ convertPrice($discountAmount) }}</span>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span class="text-dark fw-bold">Total</span>
                            <span class="jsGrandTotal" id="total-amount">
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
        function copyCoupon(code) {
            document.getElementById('coupon_code').value = code;
        }

        function applyCoupon() {
            let couponCode = document.getElementById('coupon_code').value;
            if (!couponCode) {
                $.notify({ message: 'Please enter a coupon code!' }, { type: 'danger', placement: { from: 'top', align: 'right' } });
                return;
            }

            $.ajax({
                type: "POST",
                url: "/apply-coupon",
                data: {
                    promo_code: $('#coupon_code').val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.success) {
                        // Show success notification
                        $.notify({
                            message: "Coupon Applied: " + response.discount,
                            title: "Success",
                            icon: "fa fa-check"
                        }, {
                            type: "success"
                        });

                        // Refresh the page after a short delay (e.g., 1.5 seconds)
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    } else {
                        // Show error notification
                        $.notify({
                            message: response.message,
                            title: "Error",
                            icon: "fa fa-times"
                        }, {
                            type: "danger"
                        });
                    }
                },
                error: function () {
                    $.notify({
                        message: "Something went wrong!",
                        title: "Error",
                        icon: "fa fa-times"
                    }, {
                        type: "danger"
                    });
                }
            });


        }

    </script>

    <script>
        document.querySelectorAll('input[name="shipping"]').forEach(input => {
            input.addEventListener('change', function () {
                let selectedShipping = this.value;

                fetch("{{ route('update-shipping-method') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ shipping_method: selectedShipping })
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

                            // Refresh the page after a short delay (e.g., 1.5 seconds)
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        } else {
                            // Show error notification
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
                    amount: "{{ convertPrice($grandTotalWithShipping, true) }}", // Now numeric only
                    currency: "{{ auth()->user()->country == 'USA' ? 'USD' : (auth()->user()->country == 'Canada' ? 'CAD' : 'AUD') }}",
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