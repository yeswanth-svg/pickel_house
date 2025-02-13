@extends('layouts.app')
@section('title', 'Checkout')


@section('content')

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
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-primary w-50 me-2">Shop Pay</button>
                    <button class="btn btn-dark w-50">Google Pay</button>
                </div>

                <div class="text-center my-3">OR</div>

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
                        $countries = ['USA', 'Canada', 'Australia'];

                        // Move the user country to the top
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
                        <div class="d-flex justify-content-around align-items-center mb-2">
                            <img src="{{ asset('dish_images/' . $item->dish->image) }}" width="70" class="me-3 rounded">
                            <div>
                                <p class="mb-0 text-dark"><strong>{{ $item->dish->name }}</strong></p>
                                <small class="text-dark">{{ $item->quantity->quantity }}</small>
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
                            <span>{{ $shippingCost == 0 ? 'FREE' : '' . convertPrice($shippingCost) }}</span>
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
                            <span class="jsGrandTotal">{{ convertPrice($grandTotal + $shippingCost) }}</span>
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
        document.addEventListener("DOMContentLoaded", function () {
            let savedAddressSelect = document.getElementById("savedAddress");
            let newAddressForm = document.getElementById("newAddressForm");
            let selectedAddressInput = document.getElementById("selectedAddressInput");
            let originalAddress = {}; // Store original address for comparison

            // Default to first saved address if available
            if (savedAddressSelect.value !== "new") {
                selectedAddressInput.value = savedAddressSelect.value;
            }

            // Function to compare current form values with original
            function isAddressChanged() {
                return (
                    document.querySelector('[name="first_name"]').value !== originalAddress.first_name ||
                    document.querySelector('[name="last_name"]').value !== originalAddress.last_name ||
                    document.querySelector('[name="address"]').value !== originalAddress.address ||
                    document.querySelector('[name="city"]').value !== originalAddress.city ||
                    document.querySelector('[name="state"]').value !== originalAddress.state ||
                    document.querySelector('[name="zip_code"]').value !== originalAddress.zip_code ||
                    document.querySelector('[name="phone"]').value !== originalAddress.phone
                );
            }

            // Handle address selection
            savedAddressSelect.addEventListener("change", function () {
                let addressId = this.value;

                if (addressId === "new") {
                    newAddressForm.style.display = 'block';
                    selectedAddressInput.value = "";
                    originalAddress = {}; // Reset original address
                } else {
                    fetch(`/get-address/${addressId}`)
                        .then(response => response.json())
                        .then(data => {
                            document.querySelector('[name="first_name"]').value = data.first_name;
                            document.querySelector('[name="last_name"]').value = data.last_name;
                            document.querySelector('[name="address"]').value = data.address;
                            document.querySelector('[name="city"]').value = data.city;
                            document.querySelector('[name="state"]').value = data.state;
                            document.querySelector('[name="zip_code"]').value = data.zip_code;
                            document.querySelector('[name="phone"]').value = data.phone;

                            selectedAddressInput.value = addressId;
                            newAddressForm.style.display = 'block';
                            originalAddress = data; // Store original address
                        });
                }
            });

            // Handle form submission
            newAddressForm.addEventListener("submit", function (e) {
                if (savedAddressSelect.value !== "new" && !isAddressChanged()) {
                    // If address is the same, just update selected_address in the order
                    document.getElementById("newAddressForm").action = "/update-selected-address";
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
@endsection