@extends('layouts.app') 
@section('title', 'Your Orders')

@section('content')
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('admin/css/plugins.min.css')}}" />



    <style>
        .table td,
        .table th {
            font-size: 1rem;
            border-top-width: 0;
            border-bottom: 1px solid;
            border-color: #ebedf2 !important;
            vertical-align: middle !important;
        }

        .table thead th {
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 12px 24px !important;
            border-bottom-width: 1px;
            font-weight: 600;
        }

        .table-striped td,
        .table-striped th {
            border-top: 0 !important;
            border-bottom: 0 !important;
        }

        .table>tbody>tr>td,
        .table>tbody>tr>th {
            padding: 16px 24px !important;
        }

        .form-button-action {
            display: inline-flex;
        }

        .btn-link {
            border: 0 !important;
            background: 0 0 !important;
        }

        .btn {
            padding: 0.65rem 1.4rem;
            font-size: 1rem;
            font-weight: 500;
            opacity: 1;
            border-radius: 3px;
        }

        .btn-lg {
            font-size: 15px;
            border-radius: 6px;
            padding: 12.5px 27.5px;
            font-weight: 400;
        }

        .btn-link.btn-secondary {
            color: #6861ce !important;
        }

        .btn-link.btn-danger {
            color: #f25961 !important;
        }
    </style>

    <!-- Hero Section -->
    <div class="container-fluid py-6 my-6 mt-0"
        style="
                                                                                                                                                                                                                                                                                                                                                                                                                                background: url({{  asset('img/bg-cover.jpg')}}) no-repeat center center/cover;
                                                                                                                                                                                                                                                                                                                                                                                                                                color: white;height: 379px;">
        <div class="container text-center animated bounceInDown">
            <h1 class="display-1 mb-4" style="color: white">Order History</h1>
            <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}" style="color: white">Dashboard</a>
                </li>
                <li class="breadcrumb-item text-light" aria-current="page">Order History</li>
            </ol>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Main Content -->
    <div class="container-fluid py-4">


        <div class="row mt-4">
            <!-- Sidebar -->
            <div class="col-md-3">
                @include('partials.dashboard_sidebar')
            </div>

            <!-- Main Dashboard Content -->
            <div class="col-md-9">
                <div class="text-center">
                    <h2 class="fw-bold">Order History</h2>
                </div>
                <div class="bg-white shadow-sm p-4 rounded">
                    <div id="cancelModal" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cancel Order</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form id="cancelOrderForm" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id="order_id" name="order_id">
                                        <label for="reason">Reason for Cancellation:</label>
                                        <textarea name="cancellation_reason" id="reason" class="form-control"
                                            required></textarea>
                                        <br>
                                        <button type="submit" class="btn btn-danger w-100">Confirm Cancellation</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="orders-table" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Dish Name</th>
                                    <th>No Of Items</th>
                                    <th>Grand Total</th>
                                    <th>Order Stage</th>
                                    <th>Payment Status</th>
                                    <th>Spice Level</th>
                                    <th>Order Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td><span>{{ $order->dish->name }}</span></td>
                                        <td>{{ $order->cart_quantity }}</td>
                                        <td><span>{{ convertPrice(($order->total_amount + $order->shipping_cost) - $order->coupon_discount ?? 0) }}</span>
                                        </td>


                                        <td><span
                                                class="badge bg-{{ getOrderStageColor($order->order_stage) }}">{{ ucfirst($order->order_stage) }}</span>
                                        </td>
                                        <td><span
                                                class="badge bg-{{ getPaymentStateColor($order->payment_state) }}">{{ ucfirst($order->payment_state) }}</span>
                                        </td>
                                        <td>
                                            @if ($order->spice_level == 'mild')
                                                <span class="badge bg-success p-2">
                                                    🌱 Mild
                                                </span>
                                            @elseif ($order->spice_level == 'medium')
                                                <span class="badge bg-warning text-dark p-2">
                                                    🌶️ Medium
                                                </span>
                                            @elseif ($order->spice_level == 'spicy')
                                                <span class="badge bg-danger p-2">
                                                    🔥 Spicy
                                                </span>
                                            @elseif ($order->spice_level == 'extra_spicy')
                                                <span class="badge bg-dark text-light p-2">
                                                    ☠️ Extra Spicy
                                                </span>
                                            @endif
                                        </td>

                                        <td onclick="toggleAddress(this)" style="cursor: pointer;">
                                            @php 
                                                $address = $order->selected_address ? json_decode($order->selected_address, true) : null;
                                            @endphp
                                            <span
                                                class="short-address">{{ Str::limit($address['address'] ?? 'No Address', 30) }}</span>
                                            <span class="full-address d-none">
                                                {{ $address['address'] ?? 'No Address' }},
                                                {{ $address['city'] ?? 'No City' }},
                                                {{ $address['state'] ?? 'No State' }} - {{ $address['zip_code'] ?? 'No Zip' }},
                                                Phone: {{ $address['phone_number'] ?? 'No Phone' }}
                                            </span>
                                        </td>

                                        <td>
                                            @if(in_array($order->order_stage, ['confirmed', 'processing', 'packing']))
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="openCancelModal({{ $order->id }})">Cancel</button>
                                            @else
                                                <span
                                                    class="text-muted">{{ $order->order_stage === 'cancelled' ? 'Already Cancelled' : 'Not Cancellable' }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <!--   Core JS Files   -->
    <script src="{{asset('admin/js/core/jquery-3.7.1.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{asset('admin/js/plugin/datatables/datatables.min.js')}}"></script>

    <script>
        console.log('Datatables');
        jQuery.noConflict();
        jQuery(document).ready(function ($) {

            $("#orders-table").DataTable({
                pageLength: 10,
                scrollX: false,  // Enables horizontal scrolling
                autoWidth: true,  // Prevents auto-adjusting column widths
                fixedHeader: false, // Keeps the header fixed while scrolling
            });
        });
    </script>


    <script>
        function toggleAddress(tdElement) {
            let shortAddress = tdElement.querySelector('.short-address');
            let fullAddress = tdElement.querySelector('.full-address');

            if (fullAddress && shortAddress) {
                fullAddress.classList.toggle('d-none');
                shortAddress.classList.toggle('d-none');
            }
        }
    </script>



    <script>
        function openCancelModal(orderId) {
            document.getElementById('order_id').value = orderId;
            $('#cancelModal').modal('show');
        }

        document.getElementById('cancelOrderForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const orderId = document.getElementById('order_id').value;
            const reason = document.getElementById('reason').value;

            fetch(`/orders/${orderId}/cancel`, {
                method: 'PUT',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ cancellation_reason: reason })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success notification
                        $.notify({
                            message: "Order Cancelled: " + data.message,
                            title: "Success",
                            icon: "fa fa-check"
                        }, { type: "success" });

                        // Close modal & refresh page
                        setTimeout(() => {
                            $('#cancelModal').modal('hide');
                            location.reload();
                        }, 1500);
                    } else {
                        // Show error notification
                        $.notify({
                            message: data.message,
                            title: "Error",
                            icon: "fa fa-times"
                        }, { type: "danger" });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    $.notify({
                        message: "Something went wrong!",
                        title: "Error",
                        icon: "fa fa-times"
                    }, { type: "danger" });
                });
        });
    </script>
@endsection