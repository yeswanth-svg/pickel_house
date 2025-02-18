@extends('layouts.admin')
@section('title', 'Shipping Zones List')
@section('content')



<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Shipping Zones</h3>
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
                    <a href="#">Shipping Zones</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">All Shipping Zones</a>
                </li>
            </ul>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">All Shipping Zones</h4>

                            <button class="btn btn-primary btn-round ms-auto" id="openCreate">
                                <i class="fa fa-plus"></i>
                                Add Zone
                            </button>


                        </div>
                    </div>
                    <div class="card-body">


                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>County</th>
                                        <th>MIN weight</th>
                                        <th>Max Weight</th>
                                        <th>Standard Rate</th>
                                        <th>Priority Rate</th>
                                        <th>Currency</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($zones as $zone)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$zone->country}}</td>
                                        <td>{{$zone->min_weight}}</td>
                                        <td>{{$zone->max_weight ?: 'Max'}}</td>
                                        <td>{{$zone->standard_rate}}</td>
                                        <td>{{$zone->priority_rate}}</td>
                                        <td>{{$zone->currency}}</td>

                                        <td>
                                            <div class="form-button-action">

                                                <button class="btn btn-link btn-secondary show-button"
                                                    data-id="{{$zone->id}}" title="Show" id="openShow">
                                                    <i class="fa fa-eye"></i>
                                                </button>


                                                <button class="btn btn-link btn-lg ms-auto edit-button"
                                                    data-id="{{ $zone->id }}" title="Edit" id="openEdit">
                                                    <i class="fa fa-edit"></i>
                                                </button>


                                                <form action="{{ route('admin.shipping_zones.destroy', $zone->id) }}"
                                                    method="POST" class="delete-form" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-link btn-danger btn-lg delete-btn"
                                                        data-url="{{ route('admin.shipping_zones.destroy', $zone->id) }}"
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
            pageLength: 50,
        });

        $('#openCreate').click(function () {
            window.location.href = '{{ route('admin.shipping_zones.create') }}';
        })


    });

    $(document).on('click', '.edit-button', function () {
        var id = $(this).data('id'); // Get the team member ID from the data-id attribute
        var editUrl = '{{ route('admin.shipping_zones.edit', ':id') }}'.replace(':id', id); // Replace :id with the actual ID
        window.location.href = editUrl; // Redirect to the edit page
    });

    // Handle showing team member details in modal
    $(document).on('click', '.show-button', function () {
        var id = $(this).data('id'); // Get the team member ID from the data-id attribute
        var showUrl = '{{ route('admin.shipping_zones.show', ':id') }}'.replace(':id', id); // Replace :id with the actual ID
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
                            "Your zone has been deleted.",
                            "success"
                        );
                        form.submit(); // Submit the form if confirmed
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                            "Cancelled",
                            "Your zone is safe!",
                            "error"
                        );
                    }
                });
            });
        });
    });


</script>

@endsection