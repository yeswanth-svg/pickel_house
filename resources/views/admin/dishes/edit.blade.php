@extends('layouts.admin')
@section('title', 'Edit Dish')
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
                        <a href="#">Edit</a>
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
                            <form method="post" action="{{ route('admin.dishes.update', $dish->id) }}"
                                enctype="multipart/form-data" class="form-group">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="dishName" class="form-label text-success fw-bold fs-4">Category</label>
                                        <select class="form-select form-control" name="category_id">
                                            <option value="{{$dish->category_id}}">{{$dish->category->category_name}}
                                            </option>
                                            @foreach($categories as $type)
                                                <option value="{{$type->id}}">{{$type->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Dish Name -->
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label text-success fw-bold fs-4">Dish Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="e.g., Chicken Biryani" value="{{$dish->name}}">
                                    </div>

                                    <div class="row">
                                        <!-- Previous Image on Left -->
                                        <div class="col-md-6">
                                            <label for="" class="form-label text-success fw-bold fs-4">Previous
                                                Image :</label>

                                            <img src="{{ asset('dish_images/' . $dish->image) }}" alt="Dish Image"
                                                class="img-thumbnail" width="200">
                                        </div>

                                        <!-- New Image Upload on Right -->
                                        <div class="col-md-6">
                                            <label for="dishImage" class="form-label text-success fw-bold fs-4">Upload New
                                                Image</label>
                                            <input type="file" name="image" id="dishImage" class="form-control"
                                                accept=".png,.jpg,.gif,.webp,.jpeg">
                                            <span class="text-danger">* You can only upload png, jpg, jpeg. Max 2MB</span>
                                        </div>
                                    </div>






                                    <div class="col-md-6 mb-3">
                                        <label for="dishName"
                                            class="form-label text-success fw-bold fs-4">Description</label>
                                        <textarea type="text" name="description" id="dishName" class="form-control"
                                            placeholder="e.g., Chicken Biryani">{{$dish->description}}</textarea>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <label for="availability_status"
                                            class="form-label text-success fw-bold fs-4">Status</label>
                                        <select name="availability_status" id="availability_status" class="form-select"
                                            required>
                                            <option value="in_stock" {{ $dish->availability_status == 'in_stock' ? 'selected' : '' }}>
                                                In Stock</option>
                                            <option value="out_of_stock" {{ $dish->availability_status == 'out_of_stock' ? 'selected' : '' }}>
                                                Out Of Stock</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="spice_level" class="form-label text-success fw-bold fs-4">Spice
                                            Level</label>
                                        <select name="spice_level" id="spice_level" class="form-select" required>
                                            <option value="mild" {{ $dish->spice_level == 'mild' ? 'selected' : '' }}>
                                                Mild</option>
                                            <option value="medium" {{ $dish->spice_level == 'medium' ? 'selected' : '' }}>
                                                Medium</option>
                                            <option value="spicy" {{ $dish->spice_level == 'spicy' ? 'selected' : '' }}>
                                                Spicy</option>
                                            <option value="extra_spicy" {{ $dish->spice_level == 'extra_spicy' ? 'selected' : '' }}>
                                                Extra Spicy</option>
                                        </select>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <label for="dish_tag" class="form-label text-success fw-bold fs-4">Tag</label>
                                        <input type="text" class="form-control" id="dish_tag" name="dish_tags"
                                            placeholder="Eg: No Oil, No Preservatives (comma-separated)"
                                            value="{{ !empty($dish->dish_tags) ? implode(', ', json_decode($dish->dish_tags, true)) : '' }}">
                                    </div>



                                    <div class="col-md-6 mb-3">
                                        <label for="rating" class="form-label text-success fw-bold fs-4">Rating</label>
                                        <input type="number" name="rating" id="rating" class="form-control" placeholder=""
                                            value="{{$dish->rating}}" step="0.1">
                                    </div>
                                    <!-- Submit Button -->
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('admin.dishes.index') }}"
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