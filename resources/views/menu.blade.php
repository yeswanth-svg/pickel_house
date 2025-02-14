@extends('layouts.app')
@section('title', 'Menu')

@section('content')
  <!-- Hero Start -->
  <div class="container-fluid py-6 my-6 mt-0" style="
      background: url('img/bg-cover.jpg') no-repeat center center/cover;
      color: white;height: 379px;">
    <div class="container text-center animated bounceInDown">
    <h1 class="display-1 mb-4" style="color: white">Menu</h1>
    <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
      <li class="breadcrumb-item">
      <a href="{{url('/')}}" style="color: white">Home</a>
      </li>
      <li class="breadcrumb-item text-light" aria-current="page">Menu</li>
    </ol>
    </div>
  </div>
  <!-- Hero End -->


  <!-- Menu Start -->
  <div class="container-fluid menu py-6">
    <div class="container">
    <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
      <small
      class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">
      Our Menu
      </small>
      <h1 class="display-5 mb-5">Most Loved Pickles & Traditional Sweets Around the World</h1>
    </div>
    <div class="tab-class text-center">
      <ul class="nav nav-pills d-inline-flex justify-content-center mb-5 wow bounceInUp" data-wow-delay="0.1s">
      @foreach($categories as $key => $category)
      <li class="nav-item p-2">
      <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill category-tab" data-bs-toggle="pill"
      href="#tab-{{ $category->id }}" data-category-id="{{ $category->id }}" @if($key === 0) class="active" @endif>
      <span class="text-dark" style="width: 150px">{{ $category->category_name }}</span>
      </a>
      </li>
    @endforeach
      </ul>
      <div class="tab-content">
      @foreach($categories as $key => $category)
      <div id="tab-{{ $category->id }}" class="tab-pane fade show p-0 @if($key === 0) active @endif">
      <div class="row g-4">
      @foreach($category->dishes as $dish)
      <div class="col-lg-6 wow bounceInUp" data-wow-delay="0.1s">
      <div class="menu-item d-flex align-items-center">
      <img class="flex-shrink-0 img-fluid rounded-circle" src="{{ asset('dish_images/' . $dish->image) }}"
      alt="{{ $dish->name }}" />

      <div class="w-100 d-flex flex-column text-start ps-4">
      <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
      <h4>
        {{ $dish->name }}
        @if($dish->quantities->isNotEmpty())
      <select class="quantity-selector ms-2 small-select" data-dish-id="{{ $dish->id }}">
      @foreach($dish->quantities as $q)
      <option value="{{ $q->id }}" data-price="{{ $q->price }}">
      {{ $q->weight }}
      </option>
    @endforeach
      </select>
    @endif
      </h4>
      @auth
      @if($dish->quantities->isNotEmpty())
      <form id="add-to-wishlist-form-{{ $dish->id }}" class="add-to-cart-form">
      @csrf
      <input type="hidden" name="dish_id" value="{{ $dish->id }}">
      <input type="hidden" name="quantity_id" class="quantity-input"
      value="{{ $dish->quantities->first()->id }}">
      <input type="hidden" name="total_amount" class="price-input"
      value="{{ $dish->quantities->first()->price }}">
      <button type="button" class="btn btn-sm btn-primary mt-2 add-to-wishlist"
      data-dish-id="{{ $dish->id }}">
      <i class="fas fa-shopping-bag"></i>
      </button>
      </form>
    @else
      <p class="text-danger">No available quantities</p>
    @endif

    @endauth
      <h4 class="text-primary price-display">
        ${{ $dish->quantities->first()->price ?? 'N/A' }}
      </h4>
      </div>
      <p class="mb-0">{{ $dish->description }}</p>
      </div>
      </div>
      </div>
    @endforeach
      </div>
      </div>
    @endforeach
      </div>
    </div>
    </div>
  </div>
  <!-- Menu End -->

  <script src="{{asset('admin/js/core/jquery-3.7.1.min.js')}}"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
    // Automatically show the first category on load
    document.querySelector(".category-tab").click();

    // Update price dynamically when quantity is changed
    document.querySelectorAll('.quantity-selector').forEach(selector => {
      selector.addEventListener('change', function () {
      let dishId = this.dataset.dishId;
      let selectedOption = this.options[this.selectedIndex];
      let price = selectedOption.getAttribute('data-price');
      let quantityId = selectedOption.value;

      // Update the displayed price
      let priceDisplay = this.closest('.menu-item').querySelector('.price-display');
      priceDisplay.textContent = `$${price}`;

      // Update hidden input fields in the form
      let form = this.closest('.menu-item').querySelector('.add-to-cart-form');
      form.querySelector('.quantity-input').value = quantityId;
      form.querySelector('.price-input').value = price;
      });
    });
    });
  </script>


  <script>
    $(document).ready(function () {
    // Function to display notifications
    function showNotification(type, title, message) {
      $.notify({
      icon: type === "success" ? "fa fa-check-circle" : "fa fa-exclamation-circle",
      }, {
      type: type,
      allow_dismiss: true,
      delay: 5000,
      placement: {
        from: 'top',
        align: 'right'
      },
      offset: {
        x: 20,
        y: 60
      },
      animate: {
        enter: 'animated fadeInRight',
        exit: 'animated fadeOutRight'
      },
      template: `
          <div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert" 
            style="background: {1}; color: white; border-radius: 6px; box-shadow: 0px 4px 8px rgba(0,0,0,0.15); padding: 10px 15px; display: flex; align-items: center; font-size: 14px; min-width: 150px;">
            <span data-notify="icon" style="font-size: 18px;"></span>
            <strong style="font-size: 14px;">${title}</strong><br>
            <div>
              <span style="font-size: 16px;">${message}</span>
            </div>
          </div>
        `,
      onShow: function () {
        $(".alert-success").css("background", "#16C47F"); // Custom green
        $(".alert-danger").css("background", "#F93827"); // Custom red
      }
      });
    }

    // Handle wishlist addition via AJAX
    $(".add-to-wishlist").on("click", function (e) {
      e.preventDefault();

      let button = $(this);
      let form = button.closest("form");
      let formData = form.serialize(); // Serialize the form data

      $.ajax({
      url: "{{ route('wishlist.store') }}", // Replace with your route
      method: "POST",
      data: formData,
      success: function (response) {
        if (response.success) {
        showNotification("success", "Success", response.message);
        // Fetch updated wishlist count
        updateWishlistCount();
        } else {
        showNotification("danger", "Error", response.message);
        }
      },
      error: function (xhr) {
        showNotification("danger", "Error", "Failed to add item to wishlist.");
      }
      });

      function updateWishlistCount() {
      $.ajax({
        url: "/wishlist-count", // Create this route in your backend
        method: "GET",
        success: function (data) {
        $(".wishlist-badge").text(data.count); // Update badge count dynamically
        },
        error: function () {
        console.error("Failed to fetch updated wishlist count.");
        }
      });
      }

    });
    });

  </script>
@endsection