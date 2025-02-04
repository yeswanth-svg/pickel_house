@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<!-- Hero Start -->
<div class="container-fluid py-6 my-6 mt-0" style="
        background: url('img/bg-cover.jpg') no-repeat center center/cover;
        color: white;height: 379px;">
    <div class="container text-center animated bounceInDown">
        <h1 class="display-1 mb-4" style="color: white">Dashboard</h1>
        <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}" style="color: white">Home</a>
            </li>
            <li class="breadcrumb-item text-light" aria-current="page">Dashboard</li>
        </ol>
    </div>
</div>
<!-- Hero End -->

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-dark fw-bold fs-3 text-center">
                {{ __("User Dashboard") }}
            </div>
        </div>
    </div>
</div>
@endsection