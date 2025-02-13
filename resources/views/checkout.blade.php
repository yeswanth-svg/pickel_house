@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Left Panel: Shipping & Contact -->
            <div class="col-lg-7">
                <h4>Cart > Information > Shipping > Payment</h4>

                <!-- Express Checkout -->
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-primary w-50 me-2">Shop Pay</button>
                    <button class="btn btn-dark w-50">Google Pay</button>
                </div>

                <div class="text-center my-3">OR</div>

                <!-- Contact Info -->
                <div class="border p-3">
                    <h5>Contact</h5>

                    @auth
                        <p class="mb-1">{{ auth()->user()->email }}</p>

                        <!-- Logout Form -->
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link text-danger p-0 border-0">Log out</button>
                        </form>
                    @else
                        <p class="mb-1 text-muted">Guest User</p>
                        <a href="{{ route('login') }}" class="text-primary">Login</a>
                    @endauth
                </div>

                <!-- Shipping Address -->
                <div class="border p-3 mt-3">
                    <h5>Shipping Address</h5>
                    <div class="mb-3">
                        <label>Saved Addresses</label>
                        <select class="form-control">
                            <option>Use a new address</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Country/Region</label>
                            <select class="form-control">
                                <option>India</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>First Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Last Name</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label>Company (Optional)</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>Address</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>Apartment, Suite, etc. (Optional)</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label>City</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>State</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>ZIP Code</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label>Phone</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input">
                        <label class="form-check-label">Text me with news and offers</label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ url('/cart') }}" class="btn btn-link">Return to cart</a>
                        <button class="btn btn-primary">Continue to Shipping</button>
                    </div>
                </div>

            </div>

            <!-- Right Panel: Order Summary -->
            <div class="col-lg-5">
                <div class="card p-3">
                    <!-- Product Summary -->
                    @foreach ($cartItems as $item)
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('dish_images/' . $item->dish->image) }}" width="50" class="me-3">
                            <div>
                                <p class="mb-0"><strong>{{ $item->dish->name }}</strong></p>
                                <small>{{ $item->quantity->quantity }} gm</small>
                            </div>
                            <p class="ms-auto fw-bold">₹{{ number_format($item->quantity->price, 2) }}</p>
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
                            APPLY
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
                                    <!-- Coupon Input Field -->
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Enter coupon code">
                                        <button class="btn btn-secondary">Check</button>
                                    </div>

                                    <!-- Available Coupons -->
                                    <div class="coupon-list">
                                        <h6>Available Coupons:</h6>
                                        <div class="coupon-item p-3 border rounded">
                                            <input type="radio" name="selectedCoupon" id="coupon1" checked>
                                            <label for="coupon1" class="ms-2">
                                                <span class="badge bg-danger">MISSEDYOU</span>
                                                <br>
                                                <strong>Save ₹200</strong>
                                                <br>
                                                <small>20% off up to ₹200 on minimum purchase of ₹699.</small>
                                                <br>
                                                <small>Expires on: 30th March 2025 | 11:59 PM</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <span class="text-muted">Maximum savings: ₹200</span>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Price Breakdown -->
                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <span>Subtotal</span>
                            <span>₹{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Shipping</span>
                            <span>{{ $shipping }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total</span>
                            <span>₹{{ number_format($total, 2) }}</span>
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
@endsection