@extends('layouts.admin')
@section('title', 'Edit Dish')
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
                        <h4 class="card-title">Edit Dish</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.quantity.update', $quantity->id) }}"
                            enctype="multipart/form-data" class="form-group">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="dishName" class="form-label text-success fw-bold fs-4">Category</label>
                                    <select class="form-select form-control" name="dish_id">
                                        <option value="{{$quantity->dish_id}}">
                                            {{$quantity->dish->name}}
                                        </option>
                                        @foreach($dishes as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="quantity" class="form-label text-success fw-bold fs-4">Quantity</label>
                                    <input type="text" name="quantity" id="quantity" class="form-control"
                                        placeholder="e.g., Chicken Biryani" value="{{$quantity->quantity}}" step="0.1">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label text-success fw-bold fs-4">Price</label>
                                    <input type="number" name="price" id="price" class="form-control"
                                        placeholder="e.g.,250 g or 1 kg" value="{{$quantity->price}}" step="0.1">
                                </div>

                                <!-- Submit Button -->
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('admin.quantity.index') }}"
                                        class="btn btn-secondary ml-2">Cancel</a>
                                </div>
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