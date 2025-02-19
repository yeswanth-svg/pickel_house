@extends('layouts.app') 
@section('title', 'Edit Ticket')

@section('content')


    <!-- Hero Section -->
    <div class="container-fluid py-6 my-6 mt-0"
        style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            background: url({{  asset('img/bg-cover.jpg')}}) no-repeat center center/cover;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            color: white;height: 379px;">
        <div class="container text-center animated bounceInDown">
            <h1 class="display-1 mb-4" style="color: white">Edit Ticket</h1>
            <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}" style="color: white">Dashboard</a>
                </li>
                <li class="breadcrumb-item text-light" aria-current="page">Edit Ticket</li>
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
            <div class="col-md-9">
                <div class="card shadow-lg p-4">
                    <div class="card-body">
                        <form action="{{ route('support-tickets.update', $ticket->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <h2 class="h4 mb-4 text-primary text-center">Edit Support Ticket</h2>

                            <!-- Subject -->
                            <div class="mb-3">
                                <label class="form-label text-dark fw-semibold">Subject</label>
                                <input type="text" name="subject" value="{{ $ticket->subject }}" required
                                    class="form-control rounded-3">
                            </div>

                            <!-- Category -->
                            <div class="mb-3">
                                <label class="form-label text-dark fw-semibold">Category</label>
                                <select name="category_id" required class="form-select rounded-3">
                                    <option value="">-- Select a Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $ticket->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Priority -->
                            <div class="mb-3">
                                <label class="form-label text-dark fw-semibold">Priority</label>
                                <div class="d-flex gap-3">
                                    @foreach (['low', 'medium', 'high', 'urgent'] as $priority)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="priority" value="{{ $priority }}"
                                                {{ $ticket->priority == $priority ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ ucfirst($priority) }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label class="form-label text-dark fw-semibold">Description</label>
                                <textarea name="description" required class="form-control rounded-3"
                                    rows="4">{{ $ticket->description }}</textarea>
                            </div>

                            <!-- Previous Attachments -->
                            <div class="mb-3">
                                <label class="form-label text-dark fw-semibold">Previous Attachments</label>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($ticket->attachments as $attachment)
                                        <div class="position-relative">
                                            <a href="{{ asset($attachment->file_path) }}" target="_blank">
                                                <img src="{{ asset($attachment->file_path) }}" class="img-thumbnail"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- New Attachments -->
                            <div class="mb-3">
                                <label class="form-label text-dark fw-semibold">Add More Attachments</label>
                                <input type="file" name="attachments[]" multiple class="form-control rounded-3"
                                    accept="image/*">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 fw-bold py-2"
                                style="background: linear-gradient(135deg, #007bff, #0056b3); border: none;">Update
                                Ticket</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection