@extends('layouts.app')

@section('title', 'Registration')
@section('content')
<!-- Hero Start -->
<div class="container-fluid py-6 my-6 mt-0" style="
        background: url('img/bg-cover.jpg');
        color: white;height: 379px;">
    <div class="container text-center animated bounceInDown">
        <h1 class="display-1 mb-4" style="color: white">Register</h1>
        <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}" style="color: white">Home</a>
            </li>
            <li class="breadcrumb-item text-light" aria-current="page">Forgot Password</li>
        </ol>
    </div>
</div>
<!-- Hero End -->
<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />
<section class="py-4 d-flex justify-content-center">
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
</section>

</form>
@endsection