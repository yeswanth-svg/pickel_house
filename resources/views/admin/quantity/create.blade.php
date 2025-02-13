@extends('layouts.admin')
@section('title', 'Add Quantity')
@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Dish Quantity</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{route('admin.quantity.index')}}">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.quantity.index')}}">Dish Quantity</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">All Quantities</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Quantity</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.quantity.store') }}" enctype="multipart/form-data"
                                class="form-group">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="dishName" class="form-label text-success fw-bold fs-4">Dishes</label>
                                        <select class="form-select form-control" name="dish_id">
                                            <option value="">Select Dish</option>
                                            @foreach($dishes as $type)
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="quantity" class="form-label text-success fw-bold fs-4">Quantity</label>
                                        <input type="text" name="quantity" id="quantity" class="form-control"
                                            placeholder="e.g.,250 g or 1 kg" required value="{{old('quantity')}}"
                                            step="0.1">
                                    </div>

                                    <!-- Dish Name -->
                                    <div class="col-md-6 mb-3">
                                        <label for="original_price" class="form-label text-success fw-bold fs-4">Original
                                            Price</label>
                                        <input type="number" name="original_price" id="original_price" class="form-control"
                                            placeholder="" required value="{{old('original_price')}}" step="0.1">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="discount_price" class="form-label text-success fw-bold fs-4">Discount
                                            Price</label>
                                        <input type="number" name="discount_price" id="discount_price" class="form-control"
                                            placeholder="" required value="{{old('discount_price')}}" step="0.1">
                                    </div>




                                    <!-- Submit Button -->
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection