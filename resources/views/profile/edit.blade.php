@extends('layouts.app')
@section('title', 'Profile')

@section('content')
<!-- Hero Section -->
<div class="container-fluid py-6 my-6 mt-0" style="
        background: url('img/bg-cover.jpg');
        color: white;height: 379px;">
    <div class="container text-center animated bounceInDown">
        <h1 class="display-1 mb-4" style="color: white">Profile</h1>
        <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}" style="color: white">Home</a>
            </li>
            <li class="breadcrumb-item text-light" aria-current="page">Profile</li>
        </ol>
    </div>
</div>
<!-- Hero End -->

<!-- Main Profile Page Layout -->
<div class="container py-4">
    <div class="row">
        <!-- Sidebar (User Dashboard Menu) -->
        <div class="col-lg-3">
            @include('partials.dashboard_sidebar')
        </div>

        <!-- Profile Content -->
        <div class="col-lg-9">
            <div class="py-12">
                <div class="p-4 rounded mb-4">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class=" p-4 rounded mb-4">
                    @include('profile.partials.update-password-form')
                </div>

                <div class=" p-4 rounded">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection