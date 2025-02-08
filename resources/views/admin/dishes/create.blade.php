@extends('layouts.admin')
@section('title', 'Create Dish')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Dish</h3>
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
                    <a href="#">Dish</a>
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
                        <h4 class="card-title">Create Dish</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.dishes.store') }}" enctype="multipart/form-data"
                            class="form-group">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="dishName"
                                        class="form-label text-success fw-bold fs-4">Categories</label>
                                    <select class="form-select form-control" name="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $type)
                                            <option value="{{$type->id}}">{{$type->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Dish Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label text-success fw-bold fs-4">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="e.g., Chicken Pickel" required value="{{old('name')}}">
                                </div>

                                <!-- Dish Image -->
                                <div class="col-md-6 mb-3">
                                    <label for="image" class="form-label text-success fw-bold fs-4">Image</label>
                                    <input type="file" name="image" id="image" class="form-control"
                                        accept=".png,.jpg,.gif,.webp,.jpeg" required value="{{old('image')}}">
                                    <span class="text-danger">* You can only upload png, jpg, jpeg.Max 2MB Files</span>
                                </div>

                              

                                <div class="col-md-6 mb-3">
                                    <label for="description"
                                        class="form-label text-success fw-bold fs-4">Description</label>
                                    <textarea type="text" name="description" id="description" class="form-control"
                                        placeholder="e.g., Chicken Pickel" required>{{old('description')}}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label text-success fw-bold fs-4">Spice
                                        Level</label>
                                    <select class="form-select" name="spice_level">
                                        <option value="" selected>Select Status</option>
                                        <option value="mild">Mild</option>
                                        <option value="medium">Medium</option>
                                        <option value="spicy">Spicy</option>
                                        <option value="extra_spicy">extra Spicy</option>
                                    </select>
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