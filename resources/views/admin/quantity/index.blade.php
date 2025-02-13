@extends('layouts.admin')
@section('title', 'Dish Quantities')
@section('content')



<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Dish Quantity</h3>
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
                    <a href="#">Dish Quantity</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">All Quantities</a>
                </li>
            </ul>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">All Quantities</h4>

                            <button class="btn btn-primary btn-round ms-auto" id="openCreate">
                                <i class="fa fa-plus"></i>
                                Add Quantity
                            </button>


                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Dish Name</th>
                                        <th>Quantity</th>
                                        <th>Original Price</th>
                                        <th>Discount Price</th>


                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($quantites as $quantity)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $quantity->dish->name }}</td>
                                        <td>{{ $quantity->quantity}}</td>
                                        <td>{{$quantity->original_price}}</td>
                                        <td>{{ $quantity->discount_price}} </td>

                                        <td>
                                            <div class="form-button-action">

                                                <button class="btn btn-link btn-lg ms-auto edit-button"
                                                    data-id="{{ $quantity->id }}" title="Edit" id="openEdit">
                                                    <i class="fa fa-edit"></i>
                                                </button>


                                                <form action="{{ route('admin.quantity.destroy', $quantity->id) }}"
                                                    method="POST" class="delete-form" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-link btn-danger btn-lg delete-btn"
                                                        data-url="{{ route('admin.quantity.destroy', $quantity->id) }}"
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

        $('#openCreate').click(function () {
            window.location.href = '{{ route('admin.quantity.create') }}';
        })


    });

    $(document).on('click', '.edit-button', function () {
        var id = $(this).data('id'); // Get the team member ID from the data-id attribute
        var editUrl = '{{ route('admin.quantity.edit', ':id') }}'.replace(':id', id); // Replace :id with the actual ID
        window.location.href = editUrl; // Redirect to the edit page
    });

    // Handle showing team member details in modal
    $(document).on('click', '.show-button', function () {
        var id = $(this).data('id'); // Get the team member ID from the data-id attribute
        var showUrl = '{{ route('admin.quantity.show', ':id') }}'.replace(':id', id); // Replace :id with the actual ID
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
                            "Your Quantity has been deleted.",
                            "success"
                        );
                        form.submit(); // Submit the form if confirmed
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                            "Cancelled",
                            "Your Quantity is safe!",
                            "error"
                        );
                    }
                });
            });
        });
    });


</script>

@endsection