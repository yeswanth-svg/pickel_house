@extends('layouts.admin')
@section('title', 'Order Details')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Order Details</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.orders.index') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.orders.index') }}">Order Details</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a>Details</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card shadow border-0">
                    <div class="card-header text-white">
                        <h4 class="card-title fw-bold text-primary"><i class="fas fa-info-circle"></i>Order Details
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">User Name</label>
                                <p class="text-dark border rounded px-3 py-2">{{ $order->user->name }}</p>
                            </div>
                            @php
                                $address = json_decode($order->selected_address, true); // Decode JSON string into an associative array
                            @endphp
                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Order Address</label>
                                <ul>
                                    @if (is_array($address))
                                        <li>
                                            <strong>{{ $address['label'] }}</strong>
                                            ({{ $address['address_line_1'] }},
                                            {{ $address['address_line_2'] }},
                                            {{ $address['city'] }})
                                        </li>
                                    @else
                                        <li>Address data is invalid or unavailable.</li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Dish Name</label>
                                <p class="text-dark border rounded px-3 py-2">{{  $order->dish->name }}</p>
                            </div>

                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Total Amount</label>
                                <p class="text-dark border rounded px-3 py-2">
                                    {{  !empty($order->total_amount) ? formatCurrency($order->total_amount) : '-' }}
                                </p>
                            </div>

                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Quantity</label>
                                <p class="text-dark border rounded px-3 py-2">{{  $order->quantity->quantity }}</p>
                            </div>

                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">No Of Items</label>
                                <p class="text-dark border rounded px-3 py-2">{{  $order->cart_quantity }}</p>
                            </div>

                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Order Stage</label>
                                <p class="text-dark border rounded px-3 py-2">{{  $order->order_stage }}</p>
                            </div>

                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Payment Status</label>
                                <p class="text-dark border rounded px-3 py-2">{{  $order->payment_state }}</p>
                            </div>
                        </div>


                        <div class="mt-4">
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-info me-2">
                                <i class="icon-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>

@endsection