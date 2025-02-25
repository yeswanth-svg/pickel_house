@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

    <!-- Hero Section -->
    <div class="container-fluid py-6 my-6 mt-0" style="
            background: url('img/bg-cover.jpg');
            color: white;height: 379px;">
        <div class="container text-center animated bounceInDown">
            <h1 class="display-1 mb-4" style="color: white">Dashboard</h1>
            <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
                <li class="breadcrumb-item">
                    <a href="{{url('/')}}" style="color: white">Home</a>
                </li>
                <li class="breadcrumb-item text-light" aria-current="page">Dashboard</li>
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
                <div class="text-center">
                    <h2 class="fw-bold">User Dashboard</h2>
                </div>

                <div class="bg-white shadow-sm p-4 rounded">
                    <h4>Welcome, {{ auth()->user()->name }}!</h4>
                    <p>This is your dashboard where you can manage your profile, orders, and settings.</p>
                </div>
            </div>
        </div>
    </div>

@endsection