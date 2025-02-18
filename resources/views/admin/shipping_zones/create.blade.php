@extends('layouts.admin')
@section('title', 'Create Shipping Zone')
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
                        <a href="#">Create</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Create Shipping Zone</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.shipping_zones.store') }}"
                                enctype="multipart/form-data" class="form-group">
                                @csrf
                                <div class="row">
                                    <!-- Country -->
                                    <div class="col-md-6 mb-3">
                                        <label for="country" class="form-label text-success fw-bold fs-4">Country</label>
                                        <select class="form-select form-control" name="country" id="country" required>
                                            <option value="">Select Country</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Canada">Canada</option>
                                            <option value="USA">United States</option>
                                        </select>
                                    </div>

                                    <!-- Min Weight -->
                                    <div class="col-md-6 mb-3">
                                        <label for="min_weight" class="form-label text-success fw-bold fs-4">Min Weight
                                            (kg)</label>
                                        <input type="number" name="min_weight" id="min_weight" class="form-control" required
                                            value="{{ old('min_weight') }}" step="0.1">
                                    </div>

                                    <!-- Max Weight -->
                                    <div class="col-md-6 mb-3">
                                        <label for="max_weight" class="form-label text-success fw-bold fs-4">Max Weight
                                            (kg)</label>
                                        <input type="number" name="max_weight" id="max_weight" class="form-control" required
                                            value="{{ old('max_weight') }}" step="0.1">
                                    </div>

                                    <!-- Standard Rate -->
                                    <div class="col-md-6 mb-3">
                                        <label for="standard_rate" class="form-label text-success fw-bold fs-4">Standard
                                            Rate</label>
                                        <input type="number" name="standard_rate" id="standard_rate" class="form-control"
                                            required value="{{ old('standard_rate') }}" step="0.1">
                                    </div>

                                    <!-- Priority Rate -->
                                    <div class="col-md-6 mb-3">
                                        <label for="priority_rate" class="form-label text-success fw-bold fs-4">Priority
                                            Rate</label>
                                        <input type="number" name="priority_rate" id="priority_rate" class="form-control"
                                            required value="{{ old('priority_rate') }}" step="0.1">
                                    </div>

                                    <!-- Currency -->
                                    <div class="col-md-6 mb-3">
                                        <label for="currency" class="form-label text-success fw-bold fs-4">Currency</label>
                                        <select class="form-select form-control" name="currency" id="currency" required>
                                            <option value="">Select Currency</option>
                                            <option value="AUD">AUD - Australian Dollar</option>
                                            <option value="CAD">CAD - Canadian Dollar</option>
                                            <option value="USD">USD - US Dollar</option>
                                        </select>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
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