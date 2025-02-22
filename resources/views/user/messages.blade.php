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
                <div class="card">
                    <div class="card-body">
                        @if($messages->isNotEmpty())
                            @foreach($messages as $message)
                                <div class="d-flex align-items-start mb-3 border-bottom pb-2">
                                    <!-- <div class="notif-img me-3">
                                                                            <img src="{{ asset('admin/img/default-profile.png') }}" alt="Profile" class="rounded-circle"
                                                                                width="40">
                                                                        </div> -->
                                    <div>
                                        <strong>{{ $message->data['username'] }}</strong>
                                        <p class="mb-1">{{ $message->data['message'] }}</p>
                                        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                        <br>
                                        <a href="{{ url('/support-tickets/' . ($message->data['ticket_id'] ?? '')) }}"
                                            class="btn btn-sm btn-primary mt-1">
                                            View Conversation
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">No new messages</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection