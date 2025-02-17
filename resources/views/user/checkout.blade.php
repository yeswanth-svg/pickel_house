@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
    <style>
        /* Prevent Text Selection */
        .no-select {
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }

        /* Dim Disabled Coupons */
        .disabled-coupon {
            pointer-events: none;
            opacity: 0.6;
        }
    </style>
    <!-- Include Animate.css for the shake effect -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <div class="container">
        <ol class="breadcrumb justify-content-start mb-3 mt-2 fs-3">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.cart') }}">Cart</a></li>
            <li class="breadcrumb-item active" aria-current="page">Information</li>
        </ol>
        <div class="row">
            <!-- Left Panel: Shipping & Contact -->
            <div class="left-panel col-12 col-lg-8">

                <!-- Express Checkout -->
                @if($rewardMessage)
                    <div id="rewardAlert" class="alert alert-success mt-2 animate__animated animate__shakeX">
                        🎉 Congratulations! You have earned: <strong>{{ $rewardMessage }}</strong>
                    </div>
                @endif


                <!-- Contact Info -->
                <div class="border p-3">
                    <h5>Contact</h5>
                    <p class="mb-1">{{ auth()->user()->email }}</p>
                </div>

                <!-- Shipping Address -->
                <div class="border p-3 mt-3">
                    <h5>Shipping Address</h5>
                    <div class="mb-3">
                        <label>Saved Addresses</label>
                        <select class="form-select" id="savedAddress">
                            <option value="new">Use a new address</option>
                            @foreach($addresses as $address)
                                <option value="{{ $address->id }}">{{ $address->address }}, {{ $address->city }}</option>
                            @endforeach
                        </select>
                    </div>

                    @php
                        $userCountry = auth()->user()->country;

                        // Mapping currency codes to country names
                        $countryMap = [
                            'USD' => 'USA',
                            'CAD' => 'Canada',
                            'AUD' => 'Australia'
                        ];

                        // Convert user country if it's a currency code
                        $userCountry = $countryMap[$userCountry] ?? $userCountry;

                        // Define available countries
                        $countries = ['USA', 'Canada', 'Australia'];

                        // Move the user country to the top if it exists in the list
                        $filteredCountries = array_diff($countries, [$userCountry]);
                        array_unshift($filteredCountries, $userCountry);
                    @endphp

                    <form id="newAddressForm" action="{{ route('save.address') }}" method="POST">
                        @csrf
                        <input type="hidden" name="selected_address" id="selectedAddressInput">


                        <div class="col-md-12 mb-2">
                            <label>Country/Region</label>
                            <select class="form-select" name="country">
                                @foreach ($filteredCountries as $country)
                                    <option value="{{ $country }}" {{ $country == $userCountry ? 'selected' : '' }}>
                                        {{ $country }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="first_name" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name" required>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label>Company (Optional)</label>
                            <input type="text" class="form-control" name="company">
                        </div>

                        <div class="mb-2">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>

                        <div class="mb-2">
                            <label>Apartment, Suite, etc. (Optional)</label>
                            <input type="text" class="form-control" name="apartment">
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label>City</label>
                                <input type="text" class="form-control" name="city" required>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>State</label>
                                <input type="text" class="form-control" name="state" required>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>ZIP Code</label>
                                <input type="text" class="form-control" name="zip_code" required>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>


                        <div class="d-flex justify-content-between">
                            <a href="{{ url('/cart') }}" class="btn btn-link">Return to cart</a>
                            <button class="btn btn-primary" type="submit">Continue to Shipping</button>
                        </div>
                    </form>

                </div>

            </div>

            <!-- Right Panel: Order Summary -->
            <div class="right-panel col-12 col-lg-4">
                <div class="card p-3">
                    <!-- Product Summary -->
                    @foreach ($cartItems as $item)
                        <div class="d-flex align-items-center justify-content-between mb-3 p-2 border rounded"
                            style="gap: 12px; background: #fff;">

                            <!-- Dish Image -->
                            <img src="{{ asset('dish_images/' . $item->dish->image) }}" width="80" height="80" class="rounded"
                                style="object-fit: cover;">

                            <!-- Dish Details -->
                            <div class="flex-grow-1">
                                <p class="mb-1 fw-bold text-dark">{{ $item->dish->name }}</p>
                                <p class="mb-0  fw-bold text-success" style="font-size: 0.85rem;">
                                    {{ $item->quantity->weight }} | Qty: {{ $item->cart_quantity }}
                                </p>
                            </div>

                            <!-- Pricing Section -->
                            <div class="text-end">
                                <p class="mb-0 fw-bold text-dark">{{ convertPrice($item->quantity->discount_price) }}</p>
                                <p class="mb-0 fw-bold text-decoration-line-through text-primary" style="font-size: 0.9rem;">
                                    {{ convertPrice($item->quantity->original_price) }}
                                </p>
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
                                    <div class="input-group mb-3">
                                        <input type="text" id="coupon_code" class="form-control"
                                            placeholder="Enter coupon code">
                                        <button class="btn btn-primary" onclick="applyCoupon()">Apply</button>
                                    </div>

                                    <h6 class="mt-3">Available Coupons:</h6>
                                    @foreach ($availableCoupons as $coupon)
                                        <div class="coupon-item p-3 border rounded d-flex justify-content-between align-items-center 
                                                                                        {{ $bestCoupon && $bestCoupon->id != $coupon->id ? 'disabled-coupon' : '' }}"
                                            oncontextmenu="return false;"> <!-- Prevent Right-Click -->

                                            <div class="no-select"> <!-- Prevent Text Selection -->
                                                <span class="badge bg-danger">{{ $coupon->code }}</span>
                                                <br>
                                                @if ($coupon->type === 'fixed')
                                                    <strong>Save {{ convertPrice($coupon->value) }}</strong>
                                                @elseif ($coupon->type === 'percentage')
                                                    <strong>Save {{ $coupon->value }}% off</strong>
                                                @endif
                                                <br>
                                                <small>Expires on:
                                                    {{ \Carbon\Carbon::parse($coupon->expiry_date)->format('d M Y | h:i A') }}</small>
                                            </div>

                                            @if ($bestCoupon && $bestCoupon->id == $coupon->id)
                                                <button class="btn btn-outline-primary btn-sm"
                                                    onclick="copyCoupon('{{ $coupon->code }}')">
                                                    Copy
                                                </button>
                                            @else
                                                <button class="btn btn-secondary btn-sm" disabled>Disabled</button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>


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
                            <span class="text-dark fw-bold">{{ convertPrice($discountedTotal) }}</span>
                        </div>

                        @if($discountAmount > 0)
                            <div class="d-flex justify-content-between text-danger fw-bold">
                                <span>Coupon Discount</span>
                                <span class="savings">- {{ convertPrice($discountAmount) }}</span>
                            </div>
                        @endif
                        <hr>

                        <div class="d-flex justify-content-between fw-bold fs-4 mt-2 mb-3">
                            <span class="text-dark fw-bold">Grand Total</span>
                            <span class="jsGrandTotal">{{ convertPrice($grandTotal) }}</span>
                        </div>

                    </div>


                    <!-- Checkout Benefits -->
                    <div class="mt-3">
                        <p><i class="fas fa-truck"></i> <strong>FAST SHIPPING</strong><br>Fast shipping across 30
                            countries
                        </p>
                        <p><i class="fas fa-lock"></i> <strong>SAFE CHECKOUT</strong><br>Our customer happiness team is
                            available 24/7</p>
                        <p><i class="fas fa-headset"></i> <strong>CUSTOMER SUPPORT</strong><br>24/7 assistance</p>
                        <p><i class="fas fa-globe"></i> <strong>NO CUSTOM DUTIES</strong><br>Enjoy no custom duties
                            across
                            any country</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let savedAddressSelect = document.getElementById("savedAddress");
            let newAddressForm = document.getElementById("newAddressForm");
            let selectedAddressInput = document.getElementById("selectedAddressInput");

            // Handle address selection
            savedAddressSelect.addEventListener("change", function () {
                let addressId = this.value;

                if (addressId === "new") {
                    newAddressForm.style.display = 'block';
                    selectedAddressInput.value = "";
                } else {
                    fetch(`/get-address/${addressId}`)
                        .then(response => response.json())
                        .then(data => {
                            document.querySelector('[name="country"]').value = data.country;
                            document.querySelector('[name="first_name"]').value = data.first_name;
                            document.querySelector('[name="last_name"]').value = data.last_name;
                            document.querySelector('[name="company"]').value = data.company || '';
                            document.querySelector('[name="address"]').value = data.address;
                            document.querySelector('[name="apartment"]').value = data.apartment || '';
                            document.querySelector('[name="city"]').value = data.city;
                            document.querySelector('[name="state"]').value = data.state;
                            document.querySelector('[name="zip_code"]').value = data.zip_code;
                            document.querySelector('[name="phone"]').value = data.phone;

                            selectedAddressInput.value = addressId;
                            newAddressForm.style.display = 'block';
                        });
                }
            });
        });

    </script>

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
        document.addEventListener("DOMContentLoaded", function () {
            setInterval(() => {
                let alertBox = document.getElementById("rewardAlert");
                if (alertBox) {
                    alertBox.classList.remove("animate__shakeX"); // Remove the class
                    void alertBox.offsetWidth; // Trigger reflow
                    alertBox.classList.add("animate__shakeX"); // Re-add the class
                }
            }, 2000); // Repeat every 1 second
        });
    </script>
@endsection