@extends('layouts.admin')
@section('title', 'All Orders List')
@section('content')


<style>
    /* For smaller screens */
    .table-responsive {

        white-space: nowrap;
        /* Prevents text wrapping inside cells */
    }

    /* Optional: Adjust cell padding for better readability on smaller screens */
    .table td,
    .table th {
        padding: 0.5rem;
    }

    .dataTables_scrollBody thead tr {
        visibility: hidden;
        /* Hides the duplicate header */
    }

    .dataTables_scrollBody thead tr th {
        height: 0;
        padding: 0;
        border: none;
        visibility: hidden;
    }
</style>


<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Orders</h3>
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
                    <a href="#">Orders</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">All Orders</a>
                </li>
            </ul>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">All Orders</h4>
                        </div>
                    </div>
                    <div class="card-body">


                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Order Id</th>
                                        <th>Username</th>
                                        <th>User Address</th>
                                        <th>Dish Name</th>
                                        <th>Grand Total <i class="fas fa-info-circle" data-bs-toggle="tooltip"
                                                title="Grand Total Consits of Total Amount + Shipping Cost - Coupon Discount"
                                                data-bs-placement="top"></i></th>
                                        <th>Quantity</th>
                                        <th>No.of.Items</th>
                                        <th>Order Stage</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->user->name}}</td>
                                        <td onclick="toggleAddress(this)" style="cursor: pointer;">
                                            @php 
                                                $address = $order->selected_address ? json_decode($order->selected_address, true) : null;
                                            @endphp
                                            <span
                                                class="short-address">{{ Str::limit($address['address'] ?? 'No Address', 30) }}</span>
                                            <span class="full-address d-none">
                                                {{ $address['address'] ?? 'No Address' }},
                                                {{ $address['city'] ?? 'No City' }},
                                                {{ $address['state'] ?? 'No State' }} -
                                                {{ $address['zip_code'] ?? 'No Zip' }},
                                                Phone: {{ $address['phone_number'] ?? 'No Phone' }}
                                            </span>
                                        </td>




                                        <td>{{ $order->dish->name }}</td>

                                        <td>{{ !empty($order->total_amount) ? formatCurrency(($order->total_amount + $order->shipping_cost) - $order->coupon_discount) : '-' }}
                                        </td>
                                        <td>{{$order->quantity->weight}}</td>
                                        <td>{{$order->cart_quantity}}</td>
                                        <td>
                                            <form action="{{ route('admin.orders.update_status', $order->id) }}"
                                                method="POST" class="status-form">
                                                @csrf
                                                @method('PUT')
                                                <select name="order_stage" class="form-select status-select"
                                                    onchange="this.form.submit()">
                                                    @php
                                                        $orderStages = [
                                                            'in_cart' => 'In Cart',
                                                            'confirmed' => 'Confirmed',
                                                            'processing' => 'Processing',
                                                            'packing' => 'Packing',
                                                            'shipped' => 'Shipped',
                                                            'out_for_delivery' => 'Out for Delivery',
                                                            'delivered' => 'Delivered',
                                                            'completed' => 'Completed',
                                                            'cancelled' => 'Cancelled',
                                                            'removed_from_cart' => 'Removed From Cart',
                                                        ];
                                                    @endphp
                                                    @foreach ($orderStages as $key => $label)
                                                        <option value="{{ $key }}" {{ $order->order_stage == $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>

                                        <td>
                                            @php
                                                $paymentStateStyles = [
                                                    'pending' => 'bg-warning text-dark',
                                                    'processing' => 'bg-primary text-white',
                                                    'failed' => 'bg-danger text-white',
                                                    'completed' => 'bg-success text-white',
                                                    'refunded' => 'bg-info text-white',
                                                    'partially_refunded' => 'bg-secondary text-white',
                                                    'chargeback' => 'bg-dark text-white',
                                                ];
                                            @endphp
                                            <span
                                                class="badge {{ $paymentStateStyles[$order->payment_state] ?? 'bg-secondary text-white' }}">
                                                {{ ucfirst(str_replace('_', ' ', $order->payment_state)) }}
                                            </span>
                                        </td>


                                        <td>
                                            <div class="form-button-action">

                                                <button class="btn btn-link btn-secondary show-button"
                                                    data-id="{{$order->id}}" title="Show" id="openShow">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                                <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                                    method="POST" class="delete-form" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-link btn-danger btn-lg delete-btn"
                                                        data-url="{{ route('admin.orders.destroy', $order->id) }}"
                                                        data-bs-toggle="tooltip" title="Delete">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
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
    </div>
</div>


<script src="{{asset('admin/js/core/jquery-3.7.1.min.js')}}"></script>
<!-- Datatables -->
<script src="{{asset('admin/js/plugin/datatables/datatables.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

</script>


<script>
    $(document).ready(function () {
        // Add Row
        $("#add-row").DataTable({
            pageLength: 10,
            scrollX: true,  // Enables horizontal scrolling
            autoWidth: true,  // Prevents auto-adjusting column widths
            fixedHeader: false, // Keeps the header fixed while scrolling
        });


    });


    // Handle showing team member details in modal
    $(document).on('click', '.show-button', function () {
        var id = $(this).data('id'); // Get the team member ID from the data-id attribute
        var showUrl = '{{ route('admin.orders.show', ':id') }}'.replace(':id', id); // Replace :id with the actual ID
        window.location.href = showUrl; // Redirect to the show page
    });


    document.addEventListener('DOMContentLoaded', function () {
        // Add click event listener to all delete buttons
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                const form = this.closest('form'); // Get the associated form
                const deleteUrl = this.dataset.url; // Fetch the delete URL

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            "Deleted!",
                            "Your Order has been deleted.",
                            "success"
                        );
                        form.submit(); // Submit the form if confirmed
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                            "Cancelled",
                            "Your Order is safe!",
                            "error"
                        );
                    }
                });
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
        const toggleLinks = document.querySelectorAll('.toggle-ingredients');

        toggleLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const parent = this.closest('td');
                const truncatedList = parent.querySelector('.truncated-list');
                const fullList = parent.querySelector('.full-list');

                if (fullList.style.display === 'none') {
                    truncatedList.style.display = 'none';
                    fullList.style.display = 'inline';
                    this.textContent = 'View Less';
                } else {
                    truncatedList.style.display = 'inline';
                    fullList.style.display = 'none';
                    this.textContent = 'View More';
                }
            });
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


@endsection