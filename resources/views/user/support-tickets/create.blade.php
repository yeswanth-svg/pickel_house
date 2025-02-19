@extends('layouts.app') 
@section('title', 'Add Ticket')

@section('content')


    <!-- Hero Section -->
    <div class="container-fluid py-6 my-6 mt-0"
        style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        background: url({{  asset('img/bg-cover.jpg')}}) no-repeat center center/cover;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        color: white;height: 379px;">
        <div class="container text-center animated bounceInDown">
            <h1 class="display-1 mb-4" style="color: white">Add Ticket</h1>
            <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}" style="color: white">Dashboard</a>
                </li>
                <li class="breadcrumb-item text-light" aria-current="page">Add Ticket</li>
            </ol>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Main Content -->
    <div class="container py-4">


        <div class="row mt-4">
            <!-- Sidebar -->
            <div class="col-md-3">
                @include('partials.dashboard_sidebar')
            </div>

            <!-- Main Dashboard Content -->
            <div class="col-md-9">

                <div class="card shadow-lg p-4">
                    <div class="card-body">
                        <form action="{{ route('support-tickets.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <h2 class="h4 mb-4 text-primary text-center">Submit a Support Ticket</h2>

                            <!-- Subject -->
                            <div class="mb-3">
                                <label class="form-label text-dark fw-semibold">Subject</label>
                                <input type="text" name="subject" required class="form-control rounded-3">
                            </div>

                            <!-- Category -->
                            <div class="mb-3">
                                <label class="form-label text-dark fw-semibold">Category</label>
                                <select name="category_id" required class="form-select rounded-3">
                                    <option value="">-- Select a Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Priority -->
                            <div class="mb-3">
                                <label class="form-label text-dark fw-semibold">Priority</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority" value="low" required>
                                        <label class="form-check-label">Low</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority" value="medium">
                                        <label class="form-check-label">Medium</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority" value="high">
                                        <label class="form-check-label">High</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority" value="urgent">
                                        <label class="form-check-label">Urgent</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label class="form-label text-dark fw-semibold">Description</label>
                                <textarea name="description" required class="form-control rounded-3" rows="4"></textarea>
                            </div>

                            <!-- Attachments -->
                            <div class="mb-3">
                                <label class="form-label text-dark fw-semibold">Attachments (optional)</label>
                                <input type="file" name="attachments[]" multiple class="form-control rounded-3"
                                    accept=".jpg,.png,.jpeg">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 fw-bold py-2"
                                style="background: linear-gradient(135deg, #007bff, #0056b3); border: none;">Submit
                                Ticket</button>
                        </form>
                    </div>
                </div>


            </div>

        </div>
    </div>
@endsection