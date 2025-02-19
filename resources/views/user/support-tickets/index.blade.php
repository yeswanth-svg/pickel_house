@extends('layouts.app') 
@section('title', 'Support Tickets')

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
            color: black;
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
    <div class="container py-4">


        <div class="row mt-4">
            <!-- Sidebar -->
            <div class="col-md-3">
                @include('partials.dashboard_sidebar')
            </div>

            <!-- Main Dashboard Content -->
            <div class="col-md-9">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="m-3">Support Tickets</h4>
                        <button class="btn  btn-primary" id="createTicket" style="border-radius: 100px !important; height: fit-content;">
                                <i class="fa fa-plus"></i>
                                Add Ticket
                            </button>
                </div>
                <div class="bg-white shadow-sm p-4 rounded">

                    <div class="table-responsive">
                        <table id="orders-table" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>subject</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ticket->subject }}</td>
                                        <td>{{ $ticket->description }}</td>
                                        <td><span
                                                class="badge bg-{{ getTicketStatus($ticket->status) }}">{{ ucfirst($ticket->status) }}</span>
                                        </td>
                                        <td><span
                                                class="badge bg-{{ getTicketPriority($ticket->priority) }}">{{ ucfirst($ticket->priority) }}</span>
                                        </td>
                                        <td>
                                           <div class="d-flex justify-content-center">
                                           <button class="btn btn-link btn-secondary show-button"
                                                data-id="{{$ticket->id}}" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="See Messages" id="openShow">
                                                <i class="fa fa-eye"></i>
                                            </button>


                                                <button class="btn btn-link btn-lg ms-auto edit-button"
                                                    data-id="{{ $ticket->id }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Edit" id="openEdit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
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


    <!--   Core JS Files   -->
    <script src="{{asset('admin/js/core/jquery-3.7.1.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{asset('admin/js/plugin/datatables/datatables.min.js')}}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

    </script>
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

            $('#createTicket').click(function () {
                window.location.href = '{{ route('support-tickets.create') }}';
            })

            $(document).on('click', '.edit-button', function () {
                var id = $(this).data('id'); // Get the team member ID from the data-id attribute
                var editUrl = '{{ route('support-tickets.edit', ':id') }}'.replace(':id', id); // Replace :id with the actual ID
                window.location.href = editUrl; // Redirect to the edit page
            });

            // Handle showing team member details in modal
            $(document).on('click', '.show-button', function () {
                var id = $(this).data('id'); // Get the team member ID from the data-id attribute
                var showUrl = '{{ route('support-tickets.show', ':id') }}'.replace(':id', id); // Replace :id with the actual ID
                window.location.href = showUrl; // Redirect to the show page
            });
        });
    </script>

@endsection