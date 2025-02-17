@extends('layouts.app')
@section('title', 'Order Confirmed')
@section('content')

    <h1 class="text-center">Order confirmed sucessfully </h1>
    <div class="d-flex justify-content-center align-items-center">
        <button class="btn btn-primary" id="original_price">Back To Dashboard</button>
    </div>

    <script>

        document.getElementById('original_price').addEventListener('click', function () {
            window.location.href = '{{ route('dashboard') }}';
        });
    </script>

@endsection