@extends('layouts.app')
@section('title', 'singlepage')
@section('content')

    <div class="container mt-5">
        <div class="row">
            <!-- Left side: Product images -->
            <div class="col-lg-6 col-md-6 col-sm">
                <div class=" product-gallery d-flex">
                    <!-- Thumbnail images -->
                    <div class="thumbnail-list d-flex flex-column me-3">
                        <img src="{{ asset('img/menu-01.jpg') }}" class="img-thumbnail thumb-img mb-2 active-thumb"
                            width="80">
                        <img src="{{ asset('img/hero1.png') }}" class="img-thumbnail thumb-img mb-2" width="80">
                    </div>

                    <!-- Main Image -->
                    <div class="main-image text-center flex-grow-1">
                        <img id="mainProductImage" src="{{ asset('img/menu-01.jpg') }}" alt="Product Image"
                            class="img-fluid">
                    </div>
                </div>
            </div>

            <!-- Right side: Product details -->
            <div class="col-lg-6 col-md-6 col-sm">
                <h1>{{ $dish->name }}</h1>
                <div class="d-flex align-items-center">
                    <p class="text-dark fw-bold  m-3">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $dish->rating ? 'text-warning' : 'text-secondary' }}"></i>
                        @endfor
                        <span class="ms-2">{{ number_format($dish->rating, 1) }}</span>
                    </p>
                    <br>
                    <div class="text-start">
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


                <div class="mb-3">
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
                </div>

                <div class="mb-3">
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
                                    <button type="button" class="btn btn-lg btn-outline-warning btn-sm add-to-wishlist"
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
                                            min="1" value="1" style="width: 50px; font-size: 20px;">
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
                </div>

                <hr>

                <h4>Product Information</h4>
                <p>{{ $dish->description }}</p>

                <h5>Ingredients</h5>
                <ul>
                    <li>Besan flour</li>
                    <li>Sugar</li>
                    <li>Ghee</li>
                    <li>Cardamom powder</li>
                </ul>
            </div>
        </div>


        <!-- You may also like section -->
        <div class="mt-5">
            <h4>You may also like</h4>
            <div class="row">
                <div class="col-md-3 text-center">
                    <img src="{{ asset('images/related1.jpg') }}" class="img-fluid">
                    <p>Boondi Laddu - Rs. 175</p>
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{ asset('images/related2.jpg') }}" class="img-fluid">
                    <p>Malarapu Undalu - Rs. 180</p>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="mt-5">
            <h4>Reviews (3)</h4>
            <p class="text-warning"><strong>⭐⭐⭐⭐⭐ 5.0 (3 Reviews)</strong></p>

            <div class="review">
                <p><strong>Ramya S.</strong> ⭐⭐⭐⭐⭐</p>
                <p>"Best laddu ever! Tastes amazing."</p>
            </div>
            <div class="review">
                <p><strong>Saibaba A.</strong> ⭐⭐⭐⭐⭐</p>
                <p>"Tasty and fresh!"</p>
            </div>
        </div>
    </div>


    <script src="{{asset('admin/js/core/jquery-3.7.1.min.js')}}"></script>
    <!-- JavaScript to swap images -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const mainImage = document.getElementById("mainProductImage");
            const thumbnails = document.querySelectorAll(".thumb-img");

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener("click", function () {
                    mainImage.src = this.src;
                });
            });
        });
    </script>

    <!-- <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                            const categoryTabs = document.querySelectorAll(".category-tab");
                                            const spiceSelects = document.querySelectorAll(".select-tag2");

                                            function checkCategoryVisibility() {
                                                let activeCategory = document.querySelector(".category-tab.active");

                                                if (activeCategory && activeCategory.textContent.trim().toLowerCase() === "sweets") {
                                                    // Hide all spice-level select elements
                                                    spiceSelects.forEach(select => {
                                                        select.style.display = "none";
                                                    });
                                                } else {
                                                    // Show all spice-level select elements
                                                    spiceSelects.forEach(select => {
                                                        select.style.display = "block";
                                                    });
                                                }
                                            }

                                            // Run on page load (for default active category)
                                            checkCategoryVisibility();

                                            // Add event listeners to update when a category is clicked
                                            categoryTabs.forEach(tab => {
                                                tab.addEventListener("click", function () {
                                                    // Delay to allow Bootstrap tab change
                                                    setTimeout(checkCategoryVisibility, 100);
                                                });
                                            });
                                        });

                                    </script> -->

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