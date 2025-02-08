@extends('layouts.admin')
@section('title', 'Dish Details')
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
                    <a href="{{ route('admin.dishes.index') }}">Dish Details</a>
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
                        <h4 class="card-title fw-bold text-primary"><i class="fas fa-info-circle"></i>Dish Details
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Dish Name</label>
                                <p class="text-dark border rounded px-3 py-2">{{ $dish->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Category</label>
                                <p class="text-dark border rounded px-3 py-2">{{ $dish->category->category_name }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Description</label>
                                <p class="text-dark border rounded px-3 py-2">{{ $dish->description }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Stock Availability: </label>
                                <p class="badge px-3 py-2 
                {{ $dish->availability_status == 'in_stock' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $dish->availability_status == 'in_stock' ? 'In Stock' : 'Out of Stock' }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Spice Level: </label>
                                <p
                                    class="badge px-3 py-2 
                {{ $dish->spice_level == 'mild' ? 'bg-success' : ($dish->spice_level == 'medium' ? 'bg-warning text-dark' : ($dish->spice_level == 'spicy' ? 'bg-orange text-white' : 'bg-danger')) }}">
                                    {{ ucfirst(str_replace('_', ' ', $dish->spice_level)) }}
                                </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">

                                <label class="fs-5 fw-bold text-primary">Dish Tag: </label>
                                <p class="badge bg-info text-white px-3 py-2">
                                    {{ ucfirst(str_replace('_', ' ', $dish->dish_tag)) }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Rating</label>
                                <p class="text-dark border rounded px-3 py-2">
                                    ⭐ {{ $dish->rating }}/5
                                </p>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="fs-5 fw-bold text-primary">Dish Image</label>
                                <div class="p-2 rounded">
                                    <img src="{{ asset('dish_images/' . $dish->image) }}" alt="Dish Image"
                                        class="img-fluid rounded" width="250">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('admin.dishes.index') }}" class="btn btn-info me-2">
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