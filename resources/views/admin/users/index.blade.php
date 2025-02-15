@extends('layouts.admin')
@section('title', 'User Details')
@section('content')


<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">User Details</h3>
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
                    <a href="#">All Users</a>
                </li>
            </ul>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Users List</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Country</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->country }}</td>
                                        <td>
                                            <div class="form-button-action">

                                                <a href="{{ route('admin.users.referrals.index', $user->id) }}"
                                                    class="btn btn-primary">
                                                    Referrals
                                                </a>


                                                <button class="btn btn-link btn-secondary show-button"
                                                    data-id="{{$user->id}}" title="Show" id="openShow">
                                                    <i class="fa fa-eye"></i>
                                                </button>


                                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                    method="POST" class="delete-form" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-link btn-danger delete-btn"
                                                        data-url="{{ route('admin.users.destroy', $user->id) }}"
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
        // Initialize DataTable
        // Initialize DataTable with scrollX and fixed footer
        $('#add-row').DataTable({
            pageLength: 10,
        });

        // Ensure the parent container is styled properly



        //andle showing team member details in modal
        $(document).on('click', '.show-button', function () {
            var id = $(this).data('id'); // Get the team member ID from the data-id attribute
            var showUrl = '{{ route('admin.users.show', ':id') }}'.replace(':id', id); // Replace :id with the actual ID
            window.location.href = showUrl; // Redirect to the show page
        });

        // Show team member details in modal


        // Handle delete functionality
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                const form = this.closest('form'); // Get the associated form
                const deleteUrl = this.dataset.url; // Fetch the delete URL

                // SweetAlert confirmation for delete
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
                            "User has been deleted.",
                            "success"
                        );
                        form.submit(); // Submit the form if confirmed
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                            "Cancelled",
                            "Your User  is safe!",
                            "error"
                        );
                    }
                });
            });
        });
    });
</script>

@endsection