@extends('layouts.app')
@section('title', 'Menu')
@section('content')



  <!-- Hero Start -->
  <div class="container-fluid py-6 my-6 mt-0" style="background: url('img/bg-cover.jpg'); color: white; height: 379px;">
    <div class="container text-center animated bounceInDown">
    <h1 class="display-1 mb-4" style="color: white">Menu</h1>
    <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
      <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: white">Home</a></li>
      <li class="breadcrumb-item text-light" aria-current="page">Menu</li>
    </ol>
    </div>
  </div>
  <!-- Hero End -->

  <!-- Menu Section Start -->
  <div class="container-fluid menu py-6" id="full_menu">
    <div class="container">
    <!-- Header -->
    <div class="text-center">
      <small
      class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">
      Full Menu
      </small>
      <h1 class="display-5 mb-5">Explore Our Wide Range of Pickles & Sweets</h1>
    </div>

    <!-- Category Tabs -->
    <div class="category-tabs-wrapper">
      <ul class="nav nav-pills d-flex category-tabs mb-5">
      @foreach($categories as $key => $category)
      <li class="nav-item">
      <a class="nav-link px-3 py-2 border border-primary bg-white rounded-pill category-tab 
      {{ ($selectedCategory == $category->id) ? 'active' : '' }}"
      href="{{ route('menu', ['category' => $category->id]) }}">
      {{ $category->category_name }}
      </a>
      </li>
    @endforeach


      </ul>
    </div>

    <!-- Dishes Listing -->
    <div class="tab-content">
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      @foreach($dishes as $dish)
      <div class="col">
      <div class="menu-item d-flex align-items-center position-relative dish-card">
      <a href="{{ route('dish.details', $dish->id) }}" class="dish-overlay">
        <div class="overlay-effect d-none d-md-block"></div>
        <span class="view-button btn btn-primary btn-sm d-inline d-md-none">View</span>
      </a>

      <!-- Dish Image -->
      <div class="ratio ratio-1x1 img-responsive">
        <img src="{{ asset('dish_images/' . $dish->image) }}" alt="{{ $dish->name }}"
        class="img-fluid rounded dish-img" />
      </div>

      <!-- Dish Details -->
      <div class="w-100 d-flex flex-column text-start ps-4">
        <h4>{{ $dish->name }}</h4>
        <div class="d-flex align-items-center gap-2 mt-1">
        <span class="badge bg-success text-white px-2 py-1">
        ⭐ {{ number_format($dish->rating, 1) }}
        </span>
        </div>
        <p class="text-muted">{{ Str::limit($dish->description, 50) }}</p>
      </div>
      </div>
      </div>
    @endforeach
      </div>

      <!-- Pagination -->
      <div class="mt-4 d-flex justify-content-center">
      {{ $dishes->appends(['category' => $selectedCategory])->links() }}

      </div>

    </div>
    </div>
  </div>

  <!-- Menu Section End -->


  <script src="{{asset('admin/js/core/jquery-3.7.1.min.js')}}"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
    const dishCards = document.querySelectorAll(".dish-card");

    dishCards.forEach((card) => {
      const overlay = card.querySelector(".dish-overlay");

      // Show View button on touch (simulating hover)
      card.addEventListener("touchstart", function () {
      overlay.style.opacity = "1"; // Show overlay
      });

      // Hide View button when touching outside
      document.addEventListener("touchstart", function (event) {
      if (!card.contains(event.target)) {
        overlay.style.opacity = "0"; // Hide overlay
      }
      });
    });
    });

  </script>


@endsection