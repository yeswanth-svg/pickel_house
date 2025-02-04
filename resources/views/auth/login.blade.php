@extends('layouts.app')
@section('title', 'Login')
@section('content')
<!-- Hero Start -->
<div class="container-fluid py-6 my-6 mt-0" style="
        background: url('img/bg-cover.jpg') no-repeat center center/cover;
        color: white;height: 379px;">
    <div class="container text-center animated bounceInDown">
        <h1 class="display-1 mb-4" style="color: white">Login</h1>
        <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}" style="color: white">Home</a>
            </li>
            <li class="breadcrumb-item text-light" aria-current="page">Login</li>
        </ol>
    </div>
</div>
<!-- Hero End -->

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<section class="py-4 d-flex justify-content-center">
    <div class="card shadow-sm p-4 col-lg-5" style="
    max-width: 100%;
">
        <header class="text-center">
            <h2 class="h4 text-primary">Login</h2>
            <p class="text-muted">Access your account to continue.</p>
        </header>

        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label text-dark fw-bold">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required
                    autofocus autocomplete="username">
                <div class="invalid-feedback">Please enter a valid email.</div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label text-dark fw-bold">Password</label>
                <input type="password" class="form-control" id="password" name="password" required
                    autocomplete="current-password">
                <div class="invalid-feedback">Please enter your password.</div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                <label class="form-check-label text-dark" for="remember_me">Remember me</label>
            </div>

            <div class="text-center">
                <a href="{{ route('password.request') }}" class="d-block text-decoration-none text-muted mb-3">Forgot
                    your password?</a>
                <button type="submit" class="btn btn-primary w-100">Log in</button>
            </div>
        </form>
    </div>
</section>


@endsection