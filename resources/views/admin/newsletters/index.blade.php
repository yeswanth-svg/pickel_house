@extends('layouts.admin')
@section('title', 'Subscribers')
@section('content')



    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Subscribers</h3>
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
                        <a href="#">Subscribers</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">All Subscribers</a>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">All Subscribers</h4>

                                <button class="btn btn-primary btn-round ms-auto" id="openCreate">
                                    <i class="fa fa-plus"></i>
                                    Add Newsletter
                                </button>


                            </div>
                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Email</th>
                                            <th>Subscribed On</th>

                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subscribers as $subscriber)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{ $subscriber->email }}</td>
                                                <td>{{ $subscriber->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <div class="form-button-action">

                                                        <form action="{{ route('admin.newsletter.destroy', $subscriber->id) }}"
                                                            method="POST" class="delete-form" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn btn-link btn-danger btn-lg delete-btn"
                                                                data-url="{{ route('admin.newsletter.destroy', $subscriber->id) }}"
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
                window.location.href = '{{ route('admin.newsletter.create') }}';
            })


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
                                "Your dish has been deleted.",
                                "success"
                            );
                            form.submit(); // Submit the form if confirmed
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire(
                                "Cancelled",
                                "Your dish is safe!",
                                "error"
                            );
                        }
                    });
                });
            });
        });


    </script>

@endsection