@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Notifications</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Notifications</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">All Notifications</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-light">
                        <h4 class="mb-0">All Notifications</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">


                            @foreach ($notifications as $notification)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-start 
                                                                                            {{ $notification->read_at ? 'bg-dark text-white' : 'bg-light border-primary' }}">
                                                        <div class="ms-2 me-auto">
                                                            <div class="fw-bold">
                                                                {{ $notification->data['message'] ?? 'Notification' }}
                                                            </div>

                                                            <p class="mb-1">
                                                                <span class="text-primary">Order IDs:</span>
                                                                {{ implode(', ', $notification->data['order_ids'] ?? []) }}
                                                            </p>
                                                            <p class="mb-1">
                                                                <span class="text-primary">Payment Method:</span>
                                                                {{ $notification->data['payment_method'] ?? 'N/A' }}
                                                            </p>
                                                            <p class="mb-1">
                                                                <span class="text-primary">Status:</span>
                                                                {{ $notification->data['status'] ?? 'N/A' }}
                                                            </p>
                                                            <p class="mb-1">
                                                                <span class="text-primary">Total Amount:</span>
                                                                ₹{{ number_format($notification->data['total_amount'], 2) ?? 'N/A' }}
                                                            </p>

                                                            @php
                                                                $shippingAddress = $notification->data['shipping_address'];

                                                                // Decode only if it's a string
                                                                if (is_string($shippingAddress)) {
                                                                    $shippingAddress = json_decode($shippingAddress, true);
                                                                }
                                                            @endphp

                                                            @if (is_array($shippingAddress))
                                                                <p>
                                                                    <span class="text-primary">Address:</span>
                                                                    {{ $shippingAddress['country'] ?? 'N/A' }},
                                                                    {{ $shippingAddress['first_name'] ?? 'N/A' }}
                                                                    {{ $shippingAddress['last_name'] ?? '' }},
                                                                    {{ $shippingAddress['address'] ?? 'N/A' }},
                                                                    {{ $shippingAddress['zip_code'] ?? 'N/A' }},
                                                                    {{ $shippingAddress['phone'] ?? 'N/A' }}
                                                                </p>
                                                            @else
                                                                <p class="text-danger">Invalid Shipping Address Data</p>
                                                            @endif

                                                        </div>
                                                        <small
                                                            class="text-white align-self-end">{{ $notification->created_at->diffForHumans() }}</small>
                                                    </li>
                            @endforeach


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection