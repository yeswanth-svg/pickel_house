@extends('layouts.admin')
@section('title', 'Support Tickets')
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
            <h3 class="fw-bold mb-3">Support Tickets</h3>
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
                    <a href="#">Support Tickets</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">All Support Tickets</a>
                </li>
            </ul>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">All Support Tickets</h4>
                        </div>
                    </div>
                    <div class="card-body">


                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>UserName</th>
                                        <th>Category</th>
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Attachments</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tickets as $ticket)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$ticket->user->name}}</td>
                                        <td>{{$ticket->category->name}}</td>
                                        <td>{{$ticket->subject ?: 'Max'}}</td>
                                        <td class="toggle-description" style="cursor: pointer;">
                                            <span class="short-description">
                                                {{ Str::limit($ticket->description, 10) }}...
                                            </span>
                                            <span class="full-description d-none">
                                                {{ $ticket->description }}
                                            </span>
                                        </td>
                                        <td><span
                                                class="badge bg-{{ getTicketPriority($ticket->priority) }}">{{ ucfirst($ticket->priority) }}</span>
                                        </td>


                                        <td>
                                            <form action="{{ route('admin.tickets.change.status', $ticket->id) }}"
                                                method="POST" class="status-form">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-select status-select"
                                                    onchange="this.form.submit()">
                                                    @php
                                                        $statues = [
                                                            'open' => 'Open',
                                                            'in_progress' => 'InProgress',
                                                            'resolved' => 'Resolved',
                                                            'closed' => 'Closed',
                                                        ];
                                                    @endphp
                                                    @foreach ($statues as $key => $label)
                                                        <option value="{{ $key }}" {{ $ticket->status == $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            @foreach ($ticket->attachments as $attachment)
                                                <div class="position-relative">
                                                    <a href="{{ asset($attachment->file_path) }}" target="_blank">
                                                        Attachment {{ $loop->iteration }}
                                                    </a>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="form-button-action">

                                                <button class="btn btn-link btn-secondary show-button"
                                                    data-id="{{$ticket->id}}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="See Messages" id="openShow">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                                <form action="{{ route('admin.tickets.destroy', $ticket->id) }}"
                                                    method="POST" class="delete-form" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-link btn-danger btn-lg delete-btn"
                                                        data-url="{{ route('admin.tickets.destroy', $ticket->id) }}"
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
    $(document).ready(function () {
        // Add Row
        $("#add-row").DataTable({
            pageLength: 10,
            scrollX: true,  // Enables horizontal scrolling
            autoWidth: true,  // Prevents auto-adjusting column widths
            fixedHeader: false, // Keeps the header fixed while scrolling
        });

        $('#openCreate').click(function () {
            window.location.href = '{{ route('admin.tickets.create') }}';
        })


    });

    // Handle showing team member details in modal
    $(document).on('click', '.show-button', function () {
        var id = $(this).data('id'); // Get the team member ID from the data-id attribute
        var showUrl = '{{ route('admin.tickets.show', ':id') }}'.replace(':id', id); // Replace :id with the actual ID
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
                            "Your Ticket has been deleted.",
                            "success"
                        );
                        form.submit(); // Submit the form if confirmed
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                            "Cancelled",
                            "Your Ticket is safe!",
                            "error"
                        );
                    }
                });
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".toggle-description").forEach(function (td) {
            td.addEventListener("click", function () {
                let shortDesc = this.querySelector(".short-description");
                let fullDesc = this.querySelector(".full-description");

                if (fullDesc.classList.contains("d-none")) {
                    shortDesc.classList.add("d-none");
                    fullDesc.classList.remove("d-none");
                } else {
                    shortDesc.classList.remove("d-none");
                    fullDesc.classList.add("d-none");
                }
            });
        });
    });


</script>

@endsection