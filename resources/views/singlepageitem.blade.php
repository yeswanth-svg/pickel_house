@extends('layouts.app')
@section('title', 'singlepage')
@section('content')

    <style>
        .thumb-img {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .thumb-img:hover {
            transform: scale(1.1);
            /* Slightly enlarge the thumbnail */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            /* Add a shadow */
            border: 2px solid #ff9800;
            /* Highlight border color */
            border-radius: 8px;
        }

        .selected-thumb {
            border: 3px solid black !important;
            border-radius: 8px;

        }

        .badge {
            font-size: 0.95rem;
            /* Slightly larger text */
            border-radius: 10px;
        }

        .list-group-horizontal-md {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            padding: 0;
        }

        .list-group-item {
            font-size: 0.9rem;
            border: 1px solid #ffc107;
            display: inline-block;
        }


        @media only screen and (max-width: 749px) {
            .small--text-center {
                text-align: center !important;
            }
        }
    </style>
    <div class="container mt-5">
        <div class="row">
            <!-- Left side: Product images -->

            <div class="col-lg-7 col-md-6 col-sm-12 mb-3">
                <div class="product-gallery d-lg-flex flex-lg-row d-flex flex-column align-items-center">

                    <!-- Main Image (Top in Mobile, Right in Web View) -->
                    <div class="main-image text-center flex-grow-1 order-1 order-lg-2">
                        <img id="mainProductImage"
                            src="{{ asset('dish_images/' . $dish->images->first()->image_path ?? 'default.jpg') }}"
                            alt="Product Image" class="img-fluid rounded shadow-lg" width="450"
                            style="max-width: 100%; height: auto;">
                    </div>

                    <!-- Thumbnails (Below in Mobile, Left in Web View) -->
                    <div
                        class="thumbnail-list d-flex flex-lg-column flex-row justify-content-center gap-3 order-2 order-lg-1 mt-3">
                        @foreach($dish->images as $index => $image)
                            <img src="{{ asset('dish_images/' . $image->image_path) }}"
                                class="img-thumbnail thumb-img {{ $loop->first ? 'selected-thumb' : '' }}" width="100"
                                style="cursor: pointer;" alt="dish thumbnail">
                        @endforeach
                    </div>

                </div>
            </div>



            <!-- Right side: Product details -->
            <div class="col-lg-5 col-md-6 col-sm">
                <h1 class="small--text-center">{{ $dish->name }}</h1>
                <div class="d-flex align-items-center rating justify-content-lg-start justify-content-center">
                    @php
                        $averageRating = $dish->reviews->count() > 0 ? round($dish->reviews->avg('rating')) : 5;
                    @endphp

                    <p class="text-dark fw-bold">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $averageRating ? 'text-warning' : 'text-secondary' }}"></i>
                        @endfor
                        <span class="ms-2">
                            {{ number_format($averageRating, 1) }}&nbsp;({{ $dish->reviews->count() }})
                        </span>
                    </p>

                    <br>

                </div>
                <div class="text-start prices text-lg-start text-center">
                    <span class="fs-6 fw-bold text-success discount-price-display" style="font-size: 1.6rem !important;">
                        {{ convertPrice($dish->quantities->first()->discount_price ?? 0) }}
                    </span>
                    <p class="text-primary text-decoration-line-through original-price-display mb-0"
                        style="font-size: 1.5rem !important;">
                        {{ convertPrice($dish->quantities->first()->original_price) }}
                    </p>
                </div>

                <div class="mb-3">
                    @if(!empty(json_decode($dish->dish_tags, true)))
                        <div class="mt-2 d-flex flex-wrap gap-2 justify-content-lg-start justify-content-center">
                            @foreach(json_decode($dish->dish_tags, true) as $tag)
                                <span class="badge bg-warning text-dark px-3 py-2 fw-bold">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>



                <div class="mb-3">
                    <div class="d-flex align-items-center gap-2 select-tags">
                        <label for="weight" class="visually-hidden">Weight</label>
                        <select class="quantity-selector form-select select-tag1" data-dish-id="{{ $dish->id }}" {{ $dish->availability_status === 'out_of_stock' ? 'disabled' : '' }}>
                            @foreach($dish->quantities as $q)
                                <option value="{{ $q->id }}" data-discount-price="{{ convertPrice($q->discount_price) }}"
                                    data-original-price="{{ convertPrice($q->original_price) }}"
                                    data-normal-price="{{ $q->discount_price }}">
                                    {{ $q->weight }}
                                </option>
                            @endforeach
                        </select>

                        <label for="Spicy Level" class="visually-hidden">Spicy Level</label>
                        <select class="form-select select-tag2" {{ $dish->availability_status === 'out_of_stock' ? 'disabled' : '' }}>
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
                            <div class="d-flex align-items-center justify-content-center gap-2" id="cart-process">
                                <form id="add-to-wishlist-form-{{ $dish->id }}" class="add-to-wishlist-form">
                                    @csrf
                                    <input type="hidden" name="dish_id" value="{{ $dish->id }}">
                                    <input type="hidden" name="quantity_id" class="quantity-input1"
                                        value="{{ $dish->quantities->first()->id }}">
                                    <input type="hidden" name="total_amount" class="price-input1"
                                        value="{{ $dish->quantities->first()->original_price }}">
                                    <input type="hidden" name="spice_level" class="spice_level1">
                                    <button type="button" class="btn btn-lg btn-outline-warning  add-to-wishlist"
                                        data-dish-id="{{ $dish->id }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Add to Wishlist" aria-label="Add To Wishlist "> <span class="visually-hidden">Add To
                                            Wishlist</span>
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </form>
                                <form id="add-to-cart-form-{{$dish->id}}" class="add-to-cart-form d-flex align-items-center">
                                    @csrf
                                    <input type="hidden" name="dish_id" value="{{ $dish->id }}">
                                    <input type="hidden" name="quantity_id" class="quantity-input2"
                                        value="{{ $dish->quantities->first()->id }}">
                                    <input type="hidden" name="spice_level" class="spice_level2">
                                    <label for="cart-quantity-{{$dish->id}}" class="visually-hidden">Quantity</label>

                                    <div class="input-group input-group-sm">
                                        <button type="button" class="btn btn-outline-secondary btn-sm decrease-qty">−</button>
                                        <input type="number" name="cart_quantity" class="form-control text-center cart-quantity"
                                            min="1" value="1" style="width: 50px; font-size: 20px;">
                                        <button type="button" class="btn btn-outline-secondary btn-sm increase-qty">+</button>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-lg add-to-cart m-2"
                                        data-dish-id="{{ $dish->id }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Add to Cart" aria-label="Add To Cart ">
                                        <span class="visually-hidden">Add To Cart</span>
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

                <h1>Product Information</h1>
                <p>{{ $dish->description }}</p>

                <h4 class="mt-3">Ingredients</h4>
                @if(!empty(json_decode($dish->ingredients, true)))
                    <ul class="list-group list-group-horizontal-md flex-wrap">
                        @foreach(json_decode($dish->ingredients, true) as $ingredient)
                            <li class="list-group-item bg-light text-dark border rounded-pill px-3 py-1 m-1 fw-bold">
                                {{ $ingredient }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>


        <!-- You may also like section -->
        <!-- <div class="mt-5">
                                                                        <h4>You may also like</h4>
                                                                        <div class="row">
                                                                            <div class="col-md-3 text-center">
                                                                                <img src="" class="img-fluid">
                                                                                <p>Boondi Laddu - Rs. 175</p>
                                                                            </div>
                                                                            <div class="col-md-3 text-center">
                                                                                <img src="" class="img-fluid">
                                                                                <p>Malarapu Undalu - Rs. 180</p>
                                                                            </div>
                                                                        </div>
                                                                    </div> -->

        <!-- Reviews Section -->
        <div class="mt-5">
            <!-- Heading and Write Review Button in One Line -->
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Reviews ({{ $dish->reviews->count() }})</h4>
                <button class="btn btn-primary" id="write-review-btn">Write a Review</button>
            </div>

            <!-- Dynamic Average Rating -->
            <p class="text-warning mt-2">
                <strong>
                    {!! str_repeat('⭐', round($dish->reviews->avg('rating'))) !!}
                    {{ number_format($dish->reviews->avg('rating'), 1) }}

                </strong>
            </p>

            <!-- Display Reviews Dynamically -->
            @foreach($dish->reviews as $review)
                <div class="review">
                    <p>
                        <strong>{{ $review->user->name }}</strong>
                        {!! str_repeat('⭐', $review->rating) !!}
                    </p>
                    <p>"{{ $review->content }}"</p>
                </div>
            @endforeach

            <!-- Review Form (Hidden by Default) -->
            <div id="review-form" style="display: none; width: 50%;">
                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="dish_id" value="{{ $dish->id }}">

                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="rating">Rating</label>
                        <select class="form-select" name="rating" required>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}">{!! str_repeat('⭐', $i) !!}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="content">Your Review</label>
                        <textarea class="form-control" name="content" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>



        <script>
            document.getElementById('write-review-btn').addEventListener('click', function () {
                document.getElementById('review-form').style.display = 'block';
            });
        </script>

    </div>


    <script src="{{asset('admin/js/core/jquery-3.7.1.min.js')}}"></script>
    <!-- JavaScript to swap images -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const mainImage = document.getElementById("mainProductImage");
            const thumbnails = document.querySelectorAll(".thumb-img");

            if (thumbnails.length > 0) {
                // Set the first thumbnail as selected when the page loads
                thumbnails[0].classList.add("selected-thumb");

                // Ensure the main image matches the first thumbnail
                mainImage.src = thumbnails[0].src;
            }

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener("click", function () {
                    // Change main image
                    mainImage.src = this.src;

                    // Remove active class from all thumbnails
                    thumbnails.forEach(img => img.classList.remove("selected-thumb"));

                    // Add active class to the clicked thumbnail
                    this.classList.add("selected-thumb");
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

                    // Find the closest parent container
                    let menuItem = this.closest('.row') || this.closest('.col-md-6'); // Adjust based on your structure
                    if (!menuItem) return;

                    // Update price displays
                    let original_price_display = menuItem.querySelector('.original-price-display');
                    if (original_price_display) {
                        original_price_display.textContent = original_price;
                    }

                    let discount_price_display = menuItem.querySelector('.discount-price-display');
                    if (discount_price_display) {
                        discount_price_display.textContent = discount_price;
                    }

                    // Update form values
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
                    let menuItem = this.closest('.row') || this.closest('.col-md-6'); // Adjust based on your structure
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