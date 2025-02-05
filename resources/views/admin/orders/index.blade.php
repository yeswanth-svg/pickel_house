@extends('layouts.admin')
@section('title', 'Orders List')
@section('content')


<style>
    .table td {
        vertical-align: top;
        /* Ensure alignment for ingredients */
    }

    .truncated-list,
    .full-list {
        list-style-type: decimal;
        /* Add bullet points */
        padding-left: 20px;
        margin: 0;
    }

    .truncated-list li,
    .full-list li {
        margin-bottom: 5px;
        /* Adds space between list items */
        line-height: 1.5;
        /* Improves readability */
    }


    .table td {
        max-width: 350px;
        /* Adjust width for better alignment */
        word-wrap: break-word;
        /* Wrap long words if needed */
    }

    .badge {
        padding: 0.5em 1em;
        font-size: 0.9rem;
        border-radius: 0.5rem;
        display: inline-block;
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

                        <!-- Modal -->
                        <div class="modal fade" id="ShowModal" tabindex="-1" aria-labelledby="ShowModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ShowModalLabel">Order Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6><strong>Username:</strong></h6>
                                                <p id="UserName"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6><strong>User Selected Address:</strong></h6>
                                                <p id="selected_address"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6><strong>Dish Name:</strong></h6>
                                                <p id="dish_name"></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6><strong>Ingredients:</strong></h6>
                                                <ul id="ingredients" style="list-style-type: decimal;">
                                                    <!-- Ingredients will be populated here -->
                                                </ul>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6><strong>Total Amount</strong></h6>
                                                <p id="total_amount"></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6><strong>Status:</strong></h6>
                                                <p id="status"></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6><strong>Payment Status</strong></h6>
                                                <p id="payment_status"></p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>User Address</th>
                                        <th>Dish Name</th>
                                        <th style="width:30%">Ingredients</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Payment Status</th>
                                        <th>Payment Id</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$order->user->username}}</td>
                                        @php
                                            $address = json_decode($order->selected_address, true); // Decode JSON string into an associative array
                                        @endphp

                                        <td>
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
                                        </td>


                                        <td>{{ $order->dishes->dish_name }}</td>
                                        <td style="width: 25%;">
                                            <ul class="truncated-list">
                                                @foreach (collect(json_decode($order->ingredients, true))->take(2) as $ingredient)
                                                    <li>
                                                        <strong>{{ $ingredient['name'] }}</strong>
                                                        ({{ $ingredient['unit'] }}, Qty: {{ $ingredient['quantity'] }},
                                                        ₹{{ $ingredient['scaled_price'] }})
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <ul class="full-list" style="display: none;">
                                                @foreach (json_decode($order->ingredients, true) as $ingredient)
                                                    <li>
                                                        <strong>{{ $ingredient['name'] }}</strong>
                                                        ({{ $ingredient['unit'] }}, Qty: {{ $ingredient['quantity'] }},
                                                        ₹{{ $ingredient['scaled_price'] }})
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <a href="#" class="toggle-ingredients">View More</a>
                                        </td>



                                        <td>{{ !empty($order->total_amount) ? $order->total_amount : '-' }}</td>
                                        <td>
                                            @php
                                                $statusStyles = [
                                                    'Cart' => 'bg-light text-secondary',
                                                    'Pending Payment' => 'bg-warning text-dark',
                                                    'Processing' => 'bg-primary text-white',
                                                    'Completed' => 'bg-success text-white',
                                                    'Cancelled' => 'bg-danger text-white',
                                                ];
                                            @endphp
                                            <span
                                                class="badge {{ $statusStyles[$order->status] ?? 'bg-secondary text-white' }}">
                                                {{ $order->status }}
                                            </span>
                                        </td>

                                        <td>
                                            @if (!empty($order->payment_status))
                                                <span
                                                    class="badge {{ $order->payment_status === 'Online' ? 'bg-info text-white' : 'bg-secondary text-dark' }}">
                                                    {{ $order->payment_status === 'Online' ? 'Razorpay Payment' : $order->payment_status }}
                                                </span>
                                            @else
                                                <span class="badge bg-light text-muted">-</span>
                                            @endif
                                        </td>
                                        
                                        <td>{{ !empty($order->razorpay_payment_id) ? $order->razorpay_payment_id : '-' }}</td>
                                      
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


<script src="{{asset('js/core/jquery-3.7.1.min.js')}}"></script>
<!-- Datatables -->
<script src="{{asset('js/plugin/datatables/datatables.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        // Add Row
        $("#add-row").DataTable({
            pageLength: 10,
        });


    });
    $(document).on('click', '.edit-button', function () {
        var id = $(this).data('id'); // Get the dish ID from the data-id attribute
        window.location.href = '/admin/orders/' + id + '/edit';
    });

    document.addEventListener('DOMContentLoaded', function () {
        const showButtons = document.querySelectorAll('.show-button');

        showButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');

                // Fetch dish details using AJAX
                fetch(`/admin/orders/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        // Parse ingredients if it's a JSON string
                        if (typeof data.ingredients === 'string') {
                            try {
                                data.ingredients = JSON.parse(data.ingredients);
                            } catch (error) {
                                console.error("Error parsing ingredients:", error);
                            }
                        }

                        // Populate modal fields
                        document.getElementById('UserName').textContent = data.username;

                        document.getElementById('dish_name').textContent = data.dish_name;
                        document.getElementById('total_amount').textContent = data.total_amount;
                        document.getElementById('status').textContent = data.status;
                        document.getElementById('payment_status').textContent = data.payment_status;

                        const address = JSON.parse(data.selected_address);
                        document.getElementById('selected_address').textContent = `${address.label} (${address.address_line_1}, ${address.address_line_2} , ${address.city}, ${address.pincode})`;
                        // Format and populate ingredients
                        const ingredientsList = document.getElementById('ingredients');
                        ingredientsList.innerHTML = ''; // Clear previous list if any

                        // Ensure ingredients is an array
                        if (Array.isArray(data.ingredients)) {
                            data.ingredients.forEach(ingredient => {
                                const formattedIngredient = `${ingredient.name} (${ingredient.unit}, Qty: ${ingredient.quantity}, ₹${ingredient.scaled_price})`;
                                const listItem = document.createElement('li');
                                listItem.textContent = formattedIngredient;
                                ingredientsList.appendChild(listItem);
                            });
                        } else {
                            console.error("Ingredients is not an array:", data.ingredients);
                        }
                    })

                    .catch(error => {
                        console.error('Error fetching dish details:', error);
                    });
            });
        });
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

@endsection