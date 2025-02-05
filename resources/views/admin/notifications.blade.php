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
                                        <span class="text-primary">Order ID:</span>
                                        {{ $notification->data['order_ids'][0] ?? 'N/A' }}
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
                                        ₹{{ number_format($notification->data['total_amount'], 2) }}
                                    </p>
                                    <p>
                                        <span class="text-primary">Address:</span>
                                        {{ $notification->data['address']['address_line_1'] ?? 'N/A' }}
                                    </p>
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