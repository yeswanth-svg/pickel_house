@extends('layouts.admin')
@section('title', 'Coupons List')
@section('content')



<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Coupons</h3>
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
                    <a href="#">Coupons</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">All Coupons</a>
                </li>
            </ul>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">All Coupons</h4>

                            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                data-bs-target="#addRowModal">
                                <i class="fa fa-plus"></i>
                                Add Coupon
                            </button>


                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">Add New</span>
                                            <span class="fw-light"> Coupon </span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('admin.coupons.store')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Coupon Code</label>
                                                        <input id="addName" name="code" type="text" class="form-control"
                                                            placeholder="fill Coupon Code" required />
                                                    </div>
                                                    <div class="form-group form-group-default">
                                                        <label>Type</label>
                                                        <select class="form-control" name="type" required>
                                                            <option value=""> Select Type</option>
                                                            <option value="percentage">Percentage</option>
                                                            <option value="fixed">Fixed</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group form-group-default">
                                                        <label>Value</label>
                                                        <input id="addName" name="value" type="text"
                                                            class="form-control" placeholder="fill Value" required />
                                                    </div>

                                                    <div class="form-group form-group-default">
                                                        <label>Minimun Order Value</label>
                                                        <input id="addName" name="minimum_order_value" type="text"
                                                            class="form-control" placeholder="fill Minimun Order Value"
                                                            required />
                                                    </div>

                                                    <div class="form-group form-group-default">
                                                        <label>Expiry Date</label>
                                                        <input id="addName" name="expiry_date" type="date"
                                                            class="form-control" placeholder="fill Type Name"
                                                            required />
                                                    </div>

                                                    <div class="form-group form-group-default">
                                                        <label>Value</label>
                                                        <select class="form-control" name="active" required>
                                                            <option value=""> Select status</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer border-0">
                                                    <button type="submit" class="btn btn-primary">
                                                        Add
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="editRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">Edit</span>
                                            <span class="fw-light">Coupon</span>
                                        </h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="#">
                                            @csrf
                                            @method('PUT') <!-- Use PUT or PATCH if you're updating -->
                                            <div class="row">
                                                <div class="col-sm-12">

                                                    <div class="form-group form-group-default">
                                                        <label>Coupon Code</label>
                                                        <input id="code" name="code" type="text" class="form-control"
                                                            placeholder="Enter Code" required />
                                                    </div>

                                                    <div class="form-group form-group-default">
                                                        <label>Type</label>
                                                        <select id="type" class="form-control" name="type" required>
                                                            <option value="">Select Type</option>
                                                            <option value="percentage">Percentage</option>
                                                            <option value="fixed">Fixed</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group form-group-default">
                                                        <label>Value</label>
                                                        <input id="value" name="value" type="text" class="form-control"
                                                            placeholder="Enter Value" required />
                                                    </div>
                                                    <div class="form-group form-group-default">
                                                        <label>Minimum Order Value</label>
                                                        <input id="minimum_order_value" name="minimum_order_value"
                                                            type="number" class="form-control"
                                                            placeholder="Enter Minimum Order Value" />
                                                    </div>
                                                    <div class="form-group form-group-default">
                                                        <label>Expiry Date</label>
                                                        <input id="expiry_date" name="expiry_date" type="date"
                                                            class="form-control" required />
                                                    </div>
                                                    <div class="form-group form-group-default">
                                                        <label>Status</label>
                                                        <select id="status" class="form-control" name="active" required>
                                                            <option value="">Select Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>





                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Minimun Order Value</th>
                                        <th>Expiry Date</th>
                                        <th>Status</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($coupons as $coupon)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$coupon->code}}</td>
                                        <td>{{ $coupon->type }}</td>
                                        <td>{{ $coupon->value }}</td>
                                        <td>{{ $coupon->minimum_order_value }}</td>
                                        <td>{{ $coupon->expiry_date }}</td>
                                        <td>
                                            @if ($coupon->active = 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>

                                            @endif
                                        </td>

                                        <td>
                                            <div class="form-button-action">

                                                <button class="btn btn-link btn-lg ms-auto edit-button"
                                                    data-bs-toggle="modal" data-bs-target="#editRowModal"
                                                    data-id="{{ $coupon->id }}" data-code="{{ $coupon->code }}"
                                                    data-type="{{ $coupon->type }}" data-value="{{ $coupon->value }}"
                                                    data-mov="{{ $coupon->minimum_order_value }}"
                                                    data-date="{{ $coupon->expiry_date }}"
                                                    data-status="{{ $coupon->active}}" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>



                                                <form action="{{ route('admin.coupons.destroy', $coupon->id) }}"
                                                    method="POST" class="delete-form" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-link btn-danger btn-lg delete-btn"
                                                        data-url="{{ route('admin.coupons.destroy', $coupon->id) }}"
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
        });


        $("#addRowButton").click(function () {

            $("#addRowModal").modal("hide");
        });



    });


    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-button');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const code = this.getAttribute('data-code');
                const type = this.getAttribute('data-type');
                const value = this.getAttribute('data-value');
                const mov = this.getAttribute('data-mov');
                const date = this.getAttribute('data-date');
                const status = this.getAttribute('data-status');

                // Populate the modal fields
                const modal = document.getElementById('editRowModal');
                modal.querySelector('#code').value = code; // Code field
                modal.querySelector('#type').value = type; // Type field
                modal.querySelector('#value').value = value; // Value field
                modal.querySelector('#minimum_order_value').value = mov; // MOV field
                modal.querySelector('#expiry_date').value = date; // Expiry Date field

                // Select the appropriate type value
                const typeSelect = modal.querySelector('select[name="type"]');
                typeSelect.value = type;

                // Select the appropriate status value
                const statusSelect = modal.querySelector('select[name="active"]');
                statusSelect.value = status;

                // Update the form action with the correct ID
                const form = modal.querySelector('form');
                form.action = `/admin/coupons/${id}`;
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
                            "Your dish type has been deleted.",
                            "success"
                        );
                        form.submit(); // Submit the form if confirmed
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                            "Cancelled",
                            "Your dish type is safe!",
                            "error"
                        );
                    }
                });
            });
        });
    });


</script>

@endsection