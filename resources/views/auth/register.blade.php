@extends('layouts.app')

@section('title', 'Registration')
@section('content')
    <!-- Hero Start -->
    <div class="container-fluid py-6 my-6 mt-0" style="
                    background: url('img/bg-cover.jpg') no-repeat center center/cover;
                    color: white;height: 379px;">
        <div class="container text-center animated bounceInDown">
            <h1 class="display-1 mb-4" style="color: white">Register</h1>
            <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
                <li class="breadcrumb-item">
                    <a href="{{url('/')}}" style="color: white">Home</a>
                </li>
                <li class="breadcrumb-item text-light" aria-current="page">Register</li>
            </ol>
        </div>
    </div>
    <!-- Hero End -->

    <section class="py-4 d-flex justify-content-center">
        <div class="card shadow-sm p-4 col-lg-5" style="
                max-width: 100%;
            ">
            <header class="text-center">
                <h2 class="h4 text-primary">Register</h2>
                <p class="text-muted">Create a new account to access all features.</p>
            </header>

            <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                @csrf
                <!-- Store Referral Code -->
                <input type="hidden" name="ref" value="{{ request('ref') }}">

                <div class="mb-3">
                    <label for="name" class="form-label text-dark fw-bold">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required
                        autofocus autocomplete="name">
                    <div class="invalid-feedback">Please enter your name.</div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label text-dark fw-bold">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required
                        autocomplete="username">
                    <div class="invalid-feedback">Please enter a valid email.</div>
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label text-dark fw-bold">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                        value="{{ old('phone_number') }}" required autocomplete="username">
                    <div class="invalid-feedback">Please enter a valid Phone Number.</div>
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label text-dark fw-bold">Country</label>
                    <select type="text" class="form-select" id="country" name="country" required autocomplete="Country">
                        <option value="" selected>Select Country</option>
                        <option value="USD">USA</option>
                        <option value="CAD">Canada</option>
                        <option value="AUD">Australia</option>
                    </select>
                    <div class="invalid-feedback">Please select your country.</div>
                </div>


                <div class="mb-3">
                    <label for="password" class="form-label text-dark fw-bold">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required
                        autocomplete="new-password">
                    <div class="invalid-feedback">Please enter a password.</div>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label text-dark fw-bold">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        required autocomplete="new-password">
                    <div class="invalid-feedback">Please confirm your password.</div>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="d-block text-decoration-none text-muted mb-3">Already
                        registered?</a>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </div>
            </form>
        </div>
    </section>

@endsection