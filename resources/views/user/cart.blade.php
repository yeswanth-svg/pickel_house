@extends('layouts.app')
@section('title', 'Cart')
@section('content')




    <div class="container">
        <ol class="breadcrumb justify-content-start mb-3 mt-2 fs-3">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
        </ol>

        <!-- Left Panel: Dishes and Total -->
        <div class="row">
            <div class="left-panel col-12 col-lg-8">



                @foreach ($cartItems as $item)
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; padding: 1rem; background: #fff; border: 1px solid #ddd; border-radius: 8px; flex-wrap: wrap;">

                        <!-- Image and Details -->
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <img src="{{ asset('dish_images/' . $item->dish->image) }}" alt="{{ $item->dish->name }}"
                                style="width: 80px; height: 80px; border-radius: 8px; object-fit: cover;">
                            <div>
                                <h3 style="margin: 0; font-size: 1rem; font-weight: bold; color: #333;">{{ $item->dish->name }}
                                </h3>
                                <p style="margin: 0; font-size: 0.9rem; color: #777;">{{ $item->quantity->quantity }}</p>
                                <p style="margin: 0; font-size: 0.9rem; color: #777;">Ready to dispatch in 3 - 5 business days
                                </p>
                            </div>
                        </div>

                        <!-- Cart Quantity Counter -->


                        <!-- Price -->
                        <div class="cart__punit hide-mobile">
                            <span class="jsPrice">{{convertPrice($item->quantity->discount_price) }}</span>

                            <span
                                class="cart__compare-price cart__compare-price--punit jsPrice">{{ convertPrice($item->quantity->original_price) }}</span>

                        </div>
                        <!-- Delete Button -->
                        <form action="{{ route('user.cart.destroy', $item->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="trash-button">
                                <i class="fas fa-trash-alt"
                                    style="    font-size: 1.2rem;
                                                                                                                                                                                                                                                                        padding: 2px;"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
            <!-- Right Panel: Total Amount -->
            @if ($cartItems->isNotEmpty())
                <div class="right-panel col-12 col-lg-4">

                    <div class="card cart mt-3 p-3" style="border-radius: inherit;">

                        <p class="mb-2">
                            <i class="fas fa-gift text-primary"></i>
                            Shop for <span class="font-weight-bold text-primary">
                                {{ convertPrice($freeShippingThreshold) }}</span>
                            more for <span class="text-primary font-weight-bold">FREE SHIPPING!</span>
                        </p>
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ min(100, ($finalTotal / $freeShippingThreshold) * 100) }}%;"
                                aria-valuenow="{{ $finalTotal }}" aria-valuemin="0"
                                aria-valuemax="{{ $freeShippingThreshold }}">
                            </div>
                        </div>

                        <div class="text-muted small">No Customs Duties</div>

                        <div class="d-flex justify-content-between mt-2">
                            <span>Total:</span>
                            <span>{{ convertPrice($cartTotal) }}</span>
                        </div>

                        @if ($discountTotal > 0)
                            <div class="d-flex justify-content-between mt-2 text-danger">
                                <span>Savings:</span>
                                <span class="savings">- {{ convertPrice($discountTotal) }}</span>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between mt-3 border-top pt-2">
                            <span class="font-weight-bold">Grand Total:</span>
                            <span class="font-weight-bold">{{ convertPrice($finalTotal) }}</span>
                        </div>

                        <a href="{{ url('/checkout') }}" class="btn btn-primary btn-block mt-3">
                            CHECKOUT
                        </a>

                        <a href="{{ url('/') }}" class="btn btn-outline-primary btn-block mt-2">
                            CONTINUE SHOPPING
                        </a>
                    </div>

                </div>


            @endif

        </div>
    </div>

@endsection