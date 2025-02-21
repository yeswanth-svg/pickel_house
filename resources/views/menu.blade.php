@extends('layouts.app')
@section('title', 'Menu')
@section('content')

    <style>
    /* Menu Item */

    .menu-container {
    display: flex;
    flex-direction: row;
    }

    /* Categories (Left Sidebar) */
    .categories-panel {
    background: #fff;
    border-radius: 10px;
    margin-right: 20px;
    width: 260px;
    padding: 7px;
    }

    /* Menu Items (Right Panel) */
    .menu-items-panel {
    flex-grow: 1;
    /* Take remaining space */
    }

    .menu-item {
    display: flex;
    align-items: center;
    gap: 15px;
    /* Spacing between image and content */
    padding: 15px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    /* Image Styling (Fixed Size) */
    .menu-item img {

    width: 150px;
    object-fit: cover;
    flex-shrink: 0;
    /* Prevents image shrinking */
    }

    /* Content Layout */
    .menu-item .w-100 {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 100%;
    }

    /* Dish Name */
    .menu-item h4 {
    font-size: 21px;
    font-weight: bold !important;
    margin: 0;
    }

    /* Quantity & Spice Level Section */
    .menu-item .d-flex.align-items-center {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    }

    /* Price & Cart Section */
    .price-section {
    text-align: right;
    min-width: 120px;
    white-space: nowrap;
    }

    /* Discounted Price */
    .discount-price-display {
    font-size: 1.4rem;
    font-weight: bold;
    color: green;
    }

    /* Original Price (Strikethrough) */
    .original-price-display {
    font-size: 1.2rem;
    color: red;
    text-decoration: line-through;
    margin-top: -5px;
    /* Reduce gap between price and discount */
    }

    .menu-item .select-tag1 {
    width: 100px;
    }

    .menu-item .select-tag2 {
    width: 120px;
    }

    .list-group {
    width: 250px;
    }


    /* Responsive Adjustments */
    @media (max-width: 768px) {


    .menu-item {
      flex-direction: row;
      align-items: center;
      text-align: left;
      gap: 10px;
    }

    .menu-item img {
      width: 100px;
      /* Render as 100x100 on mobile */
      height: 100px;
      max-width: 150px;
      /* Ensure it never exceeds original size */
      object-fit: cover;
      flex-shrink: 0;
    }

    .menu-item .w-100 {
      width: 100%;
    }

    .menu-item .price-section {
      text-align: left;
      min-width: unset;
    }

    .menu-item .text-start {
      flex-grow: 1;
    }

    .menu-item .input-group {
      max-width: 90px;
    }

    .menu-item .btn {
      font-size: 12px;
      padding: 4px 6px;
    }

    .menu-item .prices {
      position: static;
      margin-top: 5px;
    }

    .menu-item #cart-process {
      display: flex !important;
      flex: none;
      position: static;
    }

    .menu-item .select-tags {
      display: flex !important;
      flex: none;
      position: static;
    }

    .menu-item h4 {
      position: static;
      font-size: 18px;
    }

    .menu-item .select-tag1 {
      width: 80px;
    }

    .menu-item .select-tag2 {
      width: 90px;
    }
    }
  </style>

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
  <div class="container py-6">
    <div class="text-center mb-5">
    <small
      class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1">
      Our Menu
    </small>
    <h1 class="display-5">Most Loved Pickles & Traditional Sweets Around the World</h1>
    </div>

    <div class="menu-container d-flex flex-lg-row flex-column">
    <!-- Categories (Left Sidebar) -->
    <div class="categories-panel">
      <div class="list-group">
      @foreach($categories as $key => $category)
      <a class="list-group-item list-group-item-action category-tab 
      d-flex align-items-center justify-content-between 
      @if($key === 0) active @endif" data-bs-toggle="pill" href="#tab-{{ $category->id }}"
      data-category-id="{{ $category->id }}">
      <span class="text-truncate">{{ $category->category_name }}</span>
      </a>
    @endforeach
      </div>
    </div>

    <!-- Menu Items (Right Panel) -->
    <div class="menu-items-panel">
      <div class="tab-content">
      @foreach($categories as $key => $category)
          <div id="tab-{{ $category->id }}" class="tab-pane fade show p-0 @if($key === 0) active @endif">
      <div class="row g-4">
      @foreach($category->dishes as $dish)
        <div class="col-lg-6">
      <div class="menu-item d-flex align-items-center position-relative">
      <div class="ratio ratio-1x1" style="width: 150px; object-fit: cover; position: relative;">
      <img src="{{ asset('dish_images/' . $dish->image) }}" alt="{{ $dish->name }}"
      class="img-fluid rounded {{ $dish->availability_status === 'out_of_stock' ? 'opacity-50' : '' }}" />

      @if($dish->availability_status === 'out_of_stock')
      <div class="position-absolute top-50 start-50 translate-middle bg-danger text-white p-2 rounded">
      Out of Stock
      </div>
    @endif


      </div>
      <div class="w-100 d-flex flex-column text-start ps-4">
      <h4 class="d-flex align-items-center">
      {{ $dish->name }}
      </h4>

      <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-2 mt-2">
      @if($dish->quantities->isNotEmpty())
      <div class="d-flex align-items-center gap-2 select-tags">
      <select class="quantity-selector form-select form-select-sm select-tag1"
      data-dish-id="{{ $dish->id }}" {{ $dish->availability_status === 'out_of_stock' ? 'disabled' : '' }}>
      @foreach($dish->quantities as $q)
      <option value="{{ $q->id }}" data-discount-price="{{ convertPrice($q->discount_price) }}"
      data-original-price="{{ convertPrice($q->original_price) }}"
      data-normal-price="{{ $q->discount_price }}">
      {{ $q->weight }}
      </option>
    @endforeach
        </select>

      <select class="form-select form-select-sm select-tag2" {{ $dish->availability_status === 'out_of_stock' ? 'disabled' : '' }}>
      <option value="">Spice Level</option>
      <option value="mild">Mild 🌶️</option>
      <option value="medium">Medium 🌶️🌶️</option>
      <option value="spicy">Spicy 🌶️🌶️🌶️</option>
      <option value="extra_spicy">Extra Spicy 🔥</option>
      </select>
      </div>
    @endif



      @auth


      @if($dish->quantities->isNotEmpty() && $dish->availability_status !== 'out_of_stock')
      <div class="d-flex align-items-center gap-2" id="cart-process">
      <form id="add-to-wishlist-form-{{ $dish->id }}" class="add-to-wishlist-form">
      @csrf
      <input type="hidden" name="dish_id" value="{{ $dish->id }}">
      <input type="hidden" name="quantity_id" class="quantity-input1"
      value="{{ $dish->quantities->first()->id }}">
      <input type="hidden" name="total_amount" class="price-input1"
      value="{{ $dish->quantities->first()->original_price }}">
      <input type="hidden" name="spice_level" class="spice_level1">
      <button type="button" class="btn btn-outline-warning btn-sm add-to-wishlist"
      data-dish-id="{{ $dish->id }}" data-bs-toggle="tooltip" data-bs-placement="top"
      title="Add to Wishlist">
      <i class="fas fa-heart"></i>
      </button>
      </form>

      <form id="add-to-cart-form-{{$dish->id}}" class="add-to-cart-form d-flex align-items-center">
      @csrf
      <input type="hidden" name="dish_id" value="{{ $dish->id }}">
      <input type="hidden" name="quantity_id" class="quantity-input2"
      value="{{ $dish->quantities->first()->id }}">
      <input type="hidden" name="spice_level" class="spice_level2">

      <div class="input-group input-group-sm" style="width: 100px;">
      <button type="button" class="btn btn-outline-secondary btn-sm decrease-qty">−</button>
      <input type="number" name="cart_quantity" class="form-control text-center cart-quantity"
      min="1" value="1" style="width: 29px; font-size: 14px;">
      <button type="button" class="btn btn-outline-secondary btn-sm increase-qty">+</button>
      </div>

      <button type="button" class="btn btn-primary btn-sm add-to-cart m-2"
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

      <div class="text-start prices">
        <span class="fs-6 fw-bold text-success discount-price-display"
        style="font-size: 1.4rem !important;">
        {{ convertPrice($dish->quantities->first()->discount_price ?? 0) }}
        </span>
        <p class="text-primary text-decoration-line-through original-price-display mb-0"
        style="font-size: 1.3rem !important;">
        {{ convertPrice($dish->quantities->first()->original_price) }}
        </p>
      </div>
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
    document.addEventListener("DOMContentLoaded", function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
      new bootstrap.Tooltip(tooltipTriggerEl);
    });
    });

  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.quantity-selector').forEach(selector => {
      selector.addEventListener('change', function () {
      let selectedOption = this.options[this.selectedIndex];
      let original_price = selectedOption.getAttribute('data-original-price');
      let discount_price = selectedOption.getAttribute('data-discount-price');
      let normal_price = selectedOption.getAttribute('data-normal-price');
      let menuItem = this.closest('.menu-item');
      if (!menuItem) return;

      let original_price_display = menuItem.querySelector('.original-price-display');
      if (original_price_display) {
        original_price_display.textContent = original_price;
      }

      let discount_price_display = menuItem.querySelector('.discount-price-display');
      if (discount_price_display) {
        discount_price_display.textContent = discount_price;
      }

      let wishlistForm = menuItem.querySelector('.add-to-wishlist-form');
      let cartForm = menuItem.querySelector('.add-to-cart-form');

      if (wishlistForm) {
        let quantityInputWishlist = wishlistForm.querySelector('.quantity-input1');
        let priceInputWishlist = wishlistForm.querySelector('.price-input1');
        if (quantityInputWishlist) quantityInputWishlist.value = selectedOption.value;
        if (priceInputWishlist) priceInputWishlist.value = normal_price;
      }

      if (cartForm) {
        let quantityInputCart = cartForm.querySelector('.quantity-input2');
        let priceInputCart = cartForm.querySelector('.price-input2');
        if (quantityInputCart) quantityInputCart.value = selectedOption.value;
        if (priceInputCart) priceInputCart.value = normal_price;
      }
      });
    });

    document.querySelectorAll('.select-tag2').forEach(spiceSelector => {
      spiceSelector.addEventListener('change', function () {
      let selectedSpiceLevel = this.value;
      let menuItem = this.closest('.menu-item');
      if (!menuItem) return;

      let wishlistForm = menuItem.querySelector('.add-to-wishlist-form');
      let cartForm = menuItem.querySelector('.add-to-cart-form');

      if (wishlistForm) {
        let spiceInputWishlist = wishlistForm.querySelector('.spice_level1');
        if (spiceInputWishlist) spiceInputWishlist.value = selectedSpiceLevel;
      }

      if (cartForm) {
        let spiceInputCart = cartForm.querySelector('.spice_level2');
        if (spiceInputCart) spiceInputCart.value = selectedSpiceLevel;
      }
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

@endsection