@extends('layouts.admin')
@section('title', 'Edit Zone')
@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Shipping Zone</h3>
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
                        <a href="#">Shipping Zone</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Edit</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Zone</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.shipping_zones.update', $zone->id) }}"
                                enctype="multipart/form-data" class="form-group">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <!-- Country -->
                                    <div class="col-md-6 mb-3">
                                        <label for="country" class="form-label text-success fw-bold fs-4">Country</label>
                                        <select class="form-select form-control" name="country" id="country" required>
                                            <option value="{{ $zone->country }}">{{ $zone->country }}</option>
                                            <option value="AUS" {{ $zone->country == 'AUS' ? 'selected' : '' }}>Australia
                                            </option>
                                            <option value="CAD" {{ $zone->country == 'CAD' ? 'selected' : '' }}>Canada
                                            </option>
                                            <option value="USA" {{ $zone->country == 'USA' ? 'selected' : '' }}>United States
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Min Weight -->
                                    <div class="col-md-6 mb-3">
                                        <label for="min_weight" class="form-label text-success fw-bold fs-4">Min Weight
                                            (kg)</label>
                                        <input type="number" name="min_weight" id="min_weight" class="form-control"
                                            value="{{ $zone->min_weight }}" required>
                                    </div>

                                    <!-- Max Weight -->
                                    <div class="col-md-6 mb-3">
                                        <label for="max_weight" class="form-label text-success fw-bold fs-4">Max Weight
                                            (kg)</label>
                                        <input type="number" name="max_weight" id="max_weight" class="form-control"
                                            value="{{ $zone->max_weight }}" required>
                                    </div>

                                    <!-- Standard Rate -->
                                    <div class="col-md-6 mb-3">
                                        <label for="standard_rate" class="form-label text-success fw-bold fs-4">Standard
                                            Rate</label>
                                        <input type="number" name="standard_rate" id="standard_rate" class="form-control"
                                            value="{{ $zone->standard_rate }}" required>
                                    </div>

                                    <!-- Priority Rate -->
                                    <div class="col-md-6 mb-3">
                                        <label for="priority_rate" class="form-label text-success fw-bold fs-4">Priority
                                            Rate</label>
                                        <input type="number" name="priority_rate" id="priority_rate" class="form-control"
                                            value="{{ $zone->priority_rate }}" required>
                                    </div>

                                    <!-- Currency -->
                                    <div class="col-md-6 mb-3">
                                        <label for="currency" class="form-label text-success fw-bold fs-4">Currency</label>
                                        <select class="form-select form-control" name="currency" id="currency" required>
                                            <option value="{{ $zone->currency }}">{{ $zone->currency }}</option>
                                            <option value="AUD" {{ $zone->currency == 'AUD' ? 'selected' : '' }}>AUD -
                                                Australian Dollar</option>
                                            <option value="CAD" {{ $zone->currency == 'CAD' ? 'selected' : '' }}>CAD -
                                                Canadian Dollar</option>
                                            <option value="USD" {{ $zone->currency == 'USD' ? 'selected' : '' }}>USD - US
                                                Dollar</option>
                                        </select>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('admin.shipping_zones.index') }}"
                                            class="btn btn-secondary ml-2">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>





                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>




@endsection