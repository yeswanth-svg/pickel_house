@extends('layouts.admin')
@section('title', 'Zone Details')
@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Dish Details</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{ route('admin.dishes.index') }}">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.dishes.index') }}">Zone Details</a>
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
                            <h4 class="card-title fw-bold text-primary"><i class="fas fa-info-circle"></i>Zone Details
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="fs-5 fw-bold text-primary">Country</label>
                                    <p class="text-dark border rounded px-3 py-2">{{ $zone->country }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="fs-5 fw-bold text-primary">Currency</label>
                                    <p class="text-dark border rounded px-3 py-2">{{ $zone->currency }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="fs-5 fw-bold text-primary">Min Weight</label>
                                    <p class="text-dark border rounded px-3 py-2">{{ $zone->min_weight }} kg</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="fs-5 fw-bold text-primary">Max Weight</label>
                                    <p class="text-dark border rounded px-3 py-2">{{ $zone->max_weight }} kg</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="fs-5 fw-bold text-primary">Standard Rate</label>
                                    <p class="text-dark border rounded px-3 py-2">{{ $zone->standard_rate }}
                                        {{ $zone->currency }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <label class="fs-5 fw-bold text-primary">Priority Rate</label>
                                    <p class="text-dark border rounded px-3 py-2">{{ $zone->priority_rate }}
                                        {{ $zone->currency }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('admin.shipping_zones.index') }}" class="btn btn-info me-2">
                                    <i class="icon-arrow-left"></i> Back
                                </a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>

@endsection