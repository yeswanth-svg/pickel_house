@extends('layouts.app')
@section('title', 'Menu')

@section('content')
  <!-- Hero Start -->
  <div class="container-fluid py-6 my-6 mt-0"
    style="background: url('img/bg-cover.jpg') no-repeat center center/cover; color: white; height: 379px;">
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
  <div class="container-fluid menu py-6">
    <div class="container">
    <div class="text-center mb-5">
      <small
      class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1">Our
      Menu</small>
      <h1 class="display-5">Most Loved Pickles & Traditional Sweets Around the World</h1>
    </div>

    <div class="row">

      <!-- Left Panel: Categories -->
      <div class="col-lg-3">
      <div class="list-group">
        @foreach($categories as $key => $category)
        <a class="list-group-item list-group-item-action category-tab 
        d-flex align-items-center justify-content-between 
        py-2 px-3 border 
        @if($key === 0) bg-danger text-white fw-bold @else bg-white text-secondary @endif" data-bs-toggle="pill"
        href="#tab-{{ $category->id }}" data-category-id="{{ $category->id }}">

        <span class="text-truncate" style="max-width: 80%;">{{ $category->category_name }}</span>
        </a>
    @endforeach
      </div>
      </div>
      <!-- Right Panel: Menu Items -->
      <div class="col-lg-9">
      <div class="tab-content">
        @foreach($categories as $key => $category)
      <div id="tab-{{ $category->id }}" class="tab-pane fade show p-0 @if($key === 0) active @endif">
      <div class="row g-4">
        @foreach($category->dishes as $dish)
      <div class="col-lg-6">
      <div class="menu-item d-flex align-items-center">
      <img class="flex-shrink-0 img-fluid rounded-circle" src="{{ asset('dish_images/' . $dish->image) }}"
      alt="{{ $dish->name }}" />
      <div class="w-100 d-flex flex-column text-start ps-4">
      <h4 class="d-flex align-items-center">{{ $dish->name }}</h4>
      <div
        class="d-flex align-items-center justify-content-between border-bottom border-primary pb-2 mb-2 mt-2">
        @if($dish->quantities->isNotEmpty())
      <select class="quantity-selector ms-2 small-select form-select form-select-sm"
      data-dish-id="{{ $dish->id }}">
      @foreach($dish->quantities as $q)
      <option value="{{ $q->id }}" data-price="{{ convertPrice($q->discount_price) }}"
      data-normal-price="{{ $q->discount_price }}">
      {{ $q->weight }}
      </option>
    @endforeach
      </select>
    @endif
        @auth
      @if($dish->quantities->isNotEmpty())
      <div class="d-flex align-items-center">
      <!-- Wishlist Button -->
      <form id="add-to-wishlist-form-{{ $dish->id }}" class="add-to-wishlist-form me-2">
      @csrf
      <input type="hidden" name="dish_id" value="{{ $dish->id }}">
      <input type="hidden" name="quantity_id" class="quantity-input1"
      value="{{ $dish->quantities->first()->id }}">
      <input type="hidden" name="total_amount" class="price-input1"
      value="{{ $dish->quantities->first()->original_price }}">
      <button type="button" class="btn btn-outline-warning btn-sm add-to-wishlist"
      data-dish-id="{{ $dish->id }}" data-bs-toggle="tooltip" data-bs-placement="top"
      title="Add to Wishlist">
      <i class="fas fa-shopping-basket"></i>
      </button>
      </form>
      <!-- Add to Cart Form -->
      <form id="add-to-cart-form-{{ $dish->id }}" class="add-to-cart-form d-flex align-items-center">
      @csrf
      <input type="hidden" name="dish_id" value="{{ $dish->id }}">
      <input type="hidden" name="quantity_id" class="quantity-input2"
      value="{{ $dish->quantities->first()->id }}">
      <div class="input-group input-group-sm me-2" style="width: 100px;">
      <button type="button" class="btn btn-outline-secondary btn-sm decrease-qty">−</button>
      <input type="number" name="cart_quantity" class="form-control text-center cart-quantity"
      min="1" value="1" style="width: 29px; font-size: 14px;">
      <button type="button" class="btn btn-outline-secondary btn-sm increase-qty">+</button>
      </div>
      <button type="button" class="btn btn-primary btn-sm add-to-cart"
      data-dish-id="{{ $dish->id }}" data-bs-toggle="tooltip" data-bs-placement="top"
      title="Add to Cart">
      <i class="fas fa-shopping-cart"></i>
      </button>
      </form>
      </div>
    @else
      <p class="text-danger">No available quantities</p>
    @endif

    @endauth
      </div>
      <div class="cart__punit hide-mobile">
        <span class="jsPrice">{{ convertPrice($dish->quantities->first()->discount_price ?? 0) }}</span>
        <h4 class="cart__compare-price cart__compare-price--punit jsPrice text-primary price-display">
        {{ convertPrice($dish->quantities->first()->original_price) }}
        </h4>
      </div>
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
  </div>
  <!-- Menu Section End -->

  <script src="{{asset('admin/js/core/jquery-3.7.1.min.js')}}"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
      new bootstrap.Tooltip(tooltipTriggerEl);
    });
    });

  </script>

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
      let normal_price = selectedOption.getAttribute('data-normal-price');
      let quantityId = selectedOption.value;

      // Update the displayed price
      let priceDisplay = this.closest('.menu-item').querySelector('.price-display');
      priceDisplay.textContent = `${price}`;

      // Update hidden input fields in the form
      let form = this.closest('.menu-item').querySelector('.add-to-wishlist-form');
      form.querySelector('.quantity-input1').value = quantityId;
      form.querySelector('.price-input1').value = normal_price;
      });
    });
    });

    document.addEventListener("DOMContentLoaded", function () {
    // Automatically show the first category on load
    document.querySelector(".category-tab").click();

    // Update price dynamically when quantity is changed
    document.querySelectorAll('.quantity-selector').forEach(selector => {
      selector.addEventListener('change', function () {
      let dishId = this.dataset.dishId;
      let selectedOption = this.options[this.selectedIndex];
      let price = selectedOption.getAttribute('data-price');
      let normal_price = selectedOption.getAttribute('data-normal-price');
      let quantityId = selectedOption.value;

      // Update the displayed price
      let priceDisplay = this.closest('.menu-item').querySelector('.price-display');
      priceDisplay.textContent = `${price}`;

      // Update hidden input fields in the form
      let form = this.closest('.menu-item').querySelector('.add-to-cart-form');
      form.querySelector('.quantity-input2').value = quantityId;
      form.querySelector('.price-input2').value = normal_price;
      });
    });
    });
  </script>

  <script>
    $(document).ready(function () {
    // Function to display notifications
    function showNotification(type, title, message) {
      $.notify({
      icon: type === "success" ? "fa fa-bell" : "fa fa-exclamation-circle",
      title: title,
      message: message
      }, {
      type: type,
      allow_dismiss: true,
      delay: 4000,
      placement: {
        from: 'top',
        align: 'right'
      },
      offset: { x: 0, y: 60 },
      animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
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
      url: "{{ route('wishlist.store') }}",
      method: "POST",
      data: formData,
      success: function (response) {
        if (response.success) {
        showNotification("success", "Success", response.message);
        updateWishlistCount();
        } else {
        showNotification("danger", "Error", response.message);
        }
      },
      error: function (xhr) {
        let errorMessage = "Failed to add item to wishlist.";
        if (xhr.responseJSON && xhr.responseJSON.message) {
        errorMessage = xhr.responseJSON.message;
        }
        showNotification("danger", "Error", errorMessage);
      }
      });
    });

    // Function to update wishlist count dynamically
    function updateWishlistCount() {
      $.ajax({
      url: "/wishlist-count",
      method: "GET",
      success: function (data) {
        $(".wishlist-badge").text(data.count);
      },
      error: function () {
        console.error("Failed to fetch updated wishlist count.");
      }
      });
    }
    });

  </script>

  <script>
    $(document).ready(function () {
    // Function to display notifications
    function showNotification(type, title, message) {
      $.notify({
      icon: type === "success" ? "fa fa-bell" : "fa fa-exclamation-circle",
      title: title,
      message: message
      }, {
      type: type,
      allow_dismiss: true,
      delay: 4000,
      placement: {
        from: 'top',
        align: 'right'
      },
      offset: { x: 0, y: 60 },
      animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
      }
      });
    }

    // Handle wishlist addition via AJAX
    $(".add-to-cart").on("click", function (e) {
      e.preventDefault();

      let button = $(this);
      let form = button.closest("form");
      let formData = form.serialize(); // Serialize the form data

      $.ajax({
      url: "{{ route('add.to.cart') }}",
      method: "POST",
      data: formData,
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      success: function (response) {
        if (response.success) {
        showNotification("success", "Success", response.message);
        updateCartCount();
        } else {
        showNotification("danger", "Error", response.message);
        }
      },
      error: function (xhr) {
        let errorMessage = "Failed to add item to wishlist.";
        if (xhr.responseJSON && xhr.responseJSON.message) {
        errorMessage = xhr.responseJSON.message;
        }
        showNotification("danger", "Error", errorMessage);
      }
      });
    });

    // Function to update wishlist count dynamically
    function updateCartCount() {
      $.ajax({
      url: "/cart-count",
      method: "GET",
      success: function (data) {
        $(".cart-badge").text(data.count);
      },
      error: function () {
        console.error("Failed to fetch updated wishlist count.");
      }
      });
    }
    });

  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
    let categoryTabs = document.querySelectorAll(".category-tab");

    categoryTabs.forEach(tab => {
      tab.addEventListener("click", function () {
      // Remove active styles from all tabs
      categoryTabs.forEach(item => {
        item.classList.remove("bg-danger", "text-white", "fw-bold");
        item.classList.add("bg-white", "text-secondary"); // Default grey text
      });

      // Add active styles to the clicked tab
      this.classList.remove("bg-white", "text-secondary");
      this.classList.add("bg-danger", "text-white", "fw-bold");
      });
    });
    });
  </script>

@endsection