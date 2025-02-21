@extends('layouts.admin')
@section('title', 'Send Newsletter')
@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3"> Newsletter</h3>
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
                        <a href="#">Newsletter</a>
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
                            <h4 class="card-title">Send Newsletter</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.sendNewsLetter') }}" enctype="multipart/form-data"
                                class="form-group">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label for="description" class="form-label text-success fw-bold fs-4">NewsLetter
                                            Content</label>
                                        <textarea type="text" name="message" id="description" class="form-control"
                                            placeholder="Enter newsletter content" required>{{old('message')}}</textarea>
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