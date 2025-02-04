@extends('layouts.app')
@section('title', 'Profile')

@section('content')
<!-- Hero Start -->
<div class="container-fluid py-6 my-6 mt-0" style="
        background: url('img/bg-cover.jpg') no-repeat center center/cover;
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

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection