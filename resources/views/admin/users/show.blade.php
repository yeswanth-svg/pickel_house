@extends('layouts.admin')
@section('title', 'User Details')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">User Details</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.users.index') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}">User Details</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a>Details</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card shadow border-0">
                    <div class="card-header text-white">
                        <h4 class="card-title fw-bold text-primary"><i class="fas fa-info-circle"></i>User Details
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Name</label>
                                <p class="text-dark border rounded px-3 py-2">{{ $user->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Email</label>
                                <p class="text-dark border rounded px-3 py-2">{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Phone Number</label>
                                <p class="text-dark border rounded px-3 py-2">
                                    {{ $user->phone_number }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Country</label>
                                <p class="text-dark border rounded px-3 py-2">{{ $user->country }}</p>
                            </div>


                        </div>


                        <div class="mt-4">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-info me-2">
                                <i class="icon-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>

@endsection