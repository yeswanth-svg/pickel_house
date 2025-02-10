@extends('layouts.admin')
@section('title', 'Payment Failed Orders List')
@section('content')


<style>
    /* For smaller screens */
    .table-responsive {

        white-space: nowrap;
        /* Prevents text wrapping inside cells */
    }
</style>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Payment Failed Orders</h3>
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
                    <a href="#">Payment Failed Orders</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">All Payment Failed Orders</a>
                </li>
            </ul>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Payment Failed Orders</h4>
                        </div>
                    </div>
                    <div class="card-body">


                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>User Address</th>
                                        <th>Dish Name</th>
                                        <th>Total Amount</th>
                                        <th>Quantity</th>
                                        <th>No.of.Items</th>
                                        <th>Status</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$order->user->name}}</td>
                                        @php
                                            $address = json_decode($order->selected_address, true);
                                            $fullAddress = '';
                                            if (is_array($address)) {
                                                $fullAddress = "{$address['label']} ({$address['address_line_1']}, {$address['address_line_2']}, {$address['city']})";
                                            }
                                        @endphp

                                        <td onclick="toggleAddress(this)" style="cursor: pointer;">
                                            <span class="short-address">
                                                {{ Str::limit($fullAddress, 20) }}
                                            </span>
                                            <span class="full-address d-none">{{ $fullAddress }}</span>
                                        </td>


                                        <td>{{ $order->dish->name }}</td>

                                        <td>{{ !empty($order->total_amount) ? formatCurrency($order->total_amount) : '-' }}
                                        </td>
                                        <td>{{$order->quantity->quantity}}</td>
                                        <td>{{$order->cart_quantity}}</td>
                                        <td>
                                            @php
                                                $orderStageStyles = [
                                                    'in_cart' => 'bg-light text-secondary',
                                                    'confirmed' => 'bg-info text-white',
                                                    'processing' => 'bg-primary text-white',
                                                    'packing' => 'bg-warning text-dark',
                                                    'shipped' => 'bg-success text-white',
                                                    'out_for_delivery' => 'bg-info text-white',
                                                    'delivered' => 'bg-success text-white',
                                                    'completed' => 'bg-success text-white',
                                                    'cancelled' => 'bg-danger text-white',
                                                    'returned' => 'bg-dark text-white',
                                                    'removed_from_cart' => 'bg-secondary text-white',
                                                ];
                                            @endphp
                                            <span
                                                class="badge {{ $orderStageStyles[$order->order_stage] ?? 'bg-secondary text-white' }}">
                                                {{ ucfirst(str_replace('_', ' ', $order->order_stage)) }}
                                            </span>
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
                                                    data-bs-toggle="modal" data-bs-target="#ShowModal"
                                                    data-id="{{$order->id}}">
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
    $(document).ready(function () {
        // Add Row
        $("#add-row").DataTable({
            pageLength: 10,
            scrollX: false,  // Enables horizontal scrolling
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

        if (fullAddress.classList.contains('d-none')) {
            fullAddress.classList.remove('d-none');
            shortAddress.classList.add('d-none');
        } else {
            fullAddress.classList.add('d-none');
            shortAddress.classList.remove('d-none');
        }
    }
</script>

@endsection