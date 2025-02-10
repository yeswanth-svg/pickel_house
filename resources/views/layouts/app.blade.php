<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Pickel House')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playball&display=swap"
        rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/animate/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet" />
    <link href="{{asset("lib/owlcarousel/owl.carousel.min.css")}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{asset("css/style.css")}}" rel="stylesheet" />
    <!-- Slick CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css" />
    <link rel="stylesheet" href="{{asset('admin/css/demo.css')}}" />

    <script src="{{asset('admin/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{asset('admin/css/fonts.min.css')}}"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>




</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar start -->
    <div class="container-fluid nav-bar">
        <div class="container">
            <nav class="navbar navbar-light navbar-expand-lg py-4">
                <a href="{{url('/')}}" class="navbar-brand">
                    <h1 class="text-primary fw-bold mb-0">
                        Pickle<span class="text-dark">House</span>
                    </h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="{{url('/')}}" class="nav-item nav-link {{request()->is('/') ? 'active' : ''}}">Home</a>
                        <a href="{{route('about-us')}}"
                            class="nav-item nav-link {{request()->is('about-us') ? 'active' : ''}}">About</a>
                        <a href="{{route('menu')}}"
                            class="nav-item nav-link {{request()->is('menu') ? 'active' : ''}}">Menu</a>
                        <!-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu bg-light">
                                <a href="book.html" class="dropdown-item">Order</a>
                                <a href="blog.html" class="dropdown-item">Our Blog</a>
                                <a href="team.html" class="dropdown-item">Our chefs</a>
                                <a href="testimonial.html" class="dropdown-item">Reviews</a>
                                <a href="404.html" class="dropdown-item">404 Page</a>
                            </div>
                        </div> -->
                        <a href="{{route('contact')}}"
                            class="nav-item nav-link {{request()->is('contact') ? 'active' : ''}}">Contact</a>

                        @if (Route::has('login'))
                            @auth
                                @if (auth()->user()->role == 'admin')
                                    <a href="{{route('admin.dashboard')}}"
                                        class="nav-item nav-link {{request()->is('dashboard') ? 'active' : ''}}">Admin Dashboard</a>

                                @else
                                    <a href="{{route('dashboard')}}"
                                        class="nav-item nav-link {{request()->is('dashboard') ? 'active' : ''}}">Dashboard</a>

                                @endif

                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle"
                                        data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                                    <div class="dropdown-menu bg-light">
                                        <a href="{{route('profile.edit')}}" class="dropdown-item">{{ __('Profile') }}</a>
                                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                            @csrf
                                            <button type="submit" class="btn btn-link text-dark text-decoration-none p-3 m-0">
                                                {{ __('Logout') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            @else
                                <a href="{{route('login')}}"
                                    class="nav-item nav-link {{request()->is('login') ? 'active' : ''}}">Login</a>

                                @if (Route::has('register'))
                                    <a href="{{route('register')}}"
                                        class="nav-item nav-link {{request()->is('register') ? 'active' : ''}}">Register</a>

                                @endif
                            @endauth
                        @endif
                    </div>
                    @auth
                                        <div class="cart-container" style="position: relative; display: inline-block;">
                                            <a href="{{route('user.cart')}}">
                                                <i class="fas fa-shopping-cart cart-icon" style="font-size:1.5rem;margin-top: 3px;"></i>
                                                <span class="uk-badge cart-badge">
                                                    {{ auth()->check() ? \App\Models\Order::where([
                            'user_id' => auth()->id(),
                            'order_stage' => 'in_cart'
                        ])->count() : 0 }}
                                                </span>
                                            </a>

                                        </div>
                    @endauth
                    <button class="btn-search btn btn-primary btn-md-square me-4 rounded-circle d-none d-lg-inline-flex"
                        data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fas fa-search"></i>
                    </button>

                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Search by keyword
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control bg-transparent p-3" placeholder="keywords"
                            aria-describedby="search-icon-1" />
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    @yield('content')

    @auth
        <!-- Floating Wishlist Icon -->
        <div class="custom-template">
            <div class="title">My Wishlist</div>
            <div class="custom-content">
                <div class="wishlist-items-container">
                    <!-- Wishlist items will be dynamically loaded here -->
                </div>
            </div>
            <div class="custom-toggle">
                <i class="fas fa-shopping-basket"></i>
                <span class="uk-badge wishlist-badge">
                    {{ auth()->check() ? \App\Models\WishlistItem::where([
            'user_id' => auth()->id(),
        ])->count() : 0 }}
                </span>
            </div>
        </div>

    @endauth


    <!-- Footer Start -->
    <div class="container-fluid footer py-6 my-6 mb-0 bg-light wow bounceInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h1 class="text-primary">
                            Pickle<span class="text-dark">House</span>
                        </h1>
                        <p class="lh-lg mb-4">
                            Authentic Experience the Rich & Authentic Flavors of Pickles.
                        </p>
                        <div class="footer-icon d-flex">
                            <a class="btn btn-primary btn-sm-square me-2 rounded-circle" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-sm-square me-2 rounded-circle" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-primary btn-sm-square me-2 rounded-circle"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="#" class="btn btn-primary btn-sm-square rounded-circle"><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="mb-4">We Provide</h4>
                        <div class="d-flex flex-column align-items-start">
                            <a class="text-body mb-3" href=""><i class="fa fa-check text-primary me-2"></i>Non-veg
                                Pickles</a>
                            <a class="text-body mb-3" href=""><i class="fa fa-check text-primary me-2"></i>Veg
                                Pickles</a>
                            <a class="text-body mb-3" href=""><i class="fa fa-check text-primary me-2"></i>Homemade
                                Sweets</a>
                            <a class="text-body mb-3" href=""><i class="fa fa-check text-primary me-2"></i>Special
                                Sweets</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="mb-4">Contact Us</h4>
                        <div class="d-flex flex-column align-items-start">
                            <p>
                                <i class="fa fa-map-marker-alt text-primary me-2"></i> 123
                                Street, Viasakhapatnam, AP
                            </p>
                            <p>
                                <i class="fa fa-phone-alt text-primary me-2"></i> (+091)
                                885544 3322
                            </p>
                            <p>
                                <i class="fas fa-envelope text-primary me-2"></i>
                                info@example.com
                            </p>
                            <p>
                                <i class="fa fa-clock text-primary me-2"></i> 24/7 Hours
                                Service
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="mb-4">Social Gallery</h4>
                        <div class="row g-2">
                            <div class="col-4">
                                <img src="img/menu-01.jpg" class="img-fluid rounded-circle border border-primary p-2"
                                    alt="" />
                            </div>
                            <div class="col-4">
                                <img src="img/menu-02.jpg" class="img-fluid rounded-circle border border-primary p-2"
                                    alt="" />
                            </div>
                            <div class="col-4">
                                <img src="img/menu-03.jpg" class="img-fluid rounded-circle border border-primary p-2"
                                    alt="" />
                            </div>
                            <div class="col-4">
                                <img src="img/menu-04.jpg" class="img-fluid rounded-circle border border-primary p-2"
                                    alt="" />
                            </div>
                            <div class="col-4">
                                <img src="img/menu-05.jpg" class="img-fluid rounded-circle border border-primary p-2"
                                    alt="" />
                            </div>
                            <div class="col-4">
                                <img src="img/menu-06.jpg" class="img-fluid rounded-circle border border-primary p-2"
                                    alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i
                                class="fas fa-copyright text-light me-2"></i>PickleHouse</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By
                    <a class="border-bottom" href="#">Rajesh</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->

    <a href="#" class="btn btn-md-square btn-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset("lib/wow/wow.min.js")}}"></script>
    <script src="{{asset("lib/easing/easing.min.js")}}"></script>
    <script src="{{asset("lib/waypoints/waypoints.min.js")}}"></script>
    <script src="{{asset("lib/counterup/counterup.min.js")}}"></script>
    <script src="{{asset("lib/lightbox/js/lightbox.min.js")}}"></script>
    <script src="{{asset("lib/owlcarousel/owl.carousel.min.js")}}"></script>


    <!-- Template Javascript -->
    <script src="{{asset("js/main.js")}}"></script>

    <script src="{{asset('admin/js/core/jquery-3.7.1.min.js')}}"></script>
    <!-- Slick JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="{{asset('admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->


    <script>
        $(document).ready(function () {
            // Success notification
            @if(session('success'))
                var content = {
                    message: "{{ session('success') }}",
                    title: "Success",
                    icon: "fa fa-bell"
                };

                $.notify(content, {
                    type: 'success', // You can change this to match your notification type
                    placement: {
                        from: 'top', // Correct capitalization
                        align: 'right' // Correct capitalization
                    },
                    time: 1000,
                    delay: 5000, // Adjust delay if needed
                });
            @endif


            // Error notification
            @if($errors->any())
                var content = {
                    message: "{{ $errors->first() }}",
                    title: "Error",
                    icon: "fa fa-exclamation-circle",
                };

                $.notify(content, {
                    type: "danger", // Error style
                    allow_dismiss: true,
                    delay: 5000,
                    placement: {
                        from: "top",
                        align: "right",
                    },
                    offset: { x: 20, y: 70 },
                    animate: {
                        enter: "animated fadeInDown",
                        exit: "animated fadeOutUp",
                    },
                });
            @endif

        });
    </script>


    <script>
        $(document).ready(function () {
            var toggle_customSidebar = false,
                custom_open = 0;

            if (!toggle_customSidebar) {
                var toggle = $('.custom-template .custom-toggle');

                toggle.on('click', function () {
                    if (custom_open === 1) {
                        $('.custom-template').removeClass('open');
                        toggle.removeClass('toggled');
                        custom_open = 0;
                    } else {
                        $('.custom-template').addClass('open');
                        toggle.addClass('toggled');
                        custom_open = 1;
                        fetchWishlistItems(); // ✅ Fetch items when opening the panel
                    }
                });

                toggle_customSidebar = true;
            }

            // Event delegation for quantity buttons
            $(document).on("click", ".decrease-qty", function () {
                let input = $(this).next(".cart-quantity");
                let value = parseInt(input.val(), 10);
                if (value > 1) {
                    input.val(value - 1);
                }
            });

            $(document).on("click", ".increase-qty", function () {
                let input = $(this).prev(".cart-quantity");
                let value = parseInt(input.val(), 10);
                input.val(value + 1);
            });

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



            // Function to Fetch Wishlist Items
            function fetchWishlistItems() {
                $.ajax({
                    url: "/get-wishlist-items",
                    method: "GET",
                    success: function (response) {
                        const wishlistContainer = $(".wishlist-items-container");
                        const wishlistCount = $(".wishlist-count");

                        wishlistContainer.empty(); // Clear existing items
                        wishlistCount.text(response.items.length); // Update count on the bag icon

                        if (response.items.length > 0) {
                            response.items.forEach(item => {
                                wishlistContainer.append(`
                            <div class="wishlist-item" data-id="${item.id}">
                                <div class="wishlist-card">
                                    <div class="wishlist-details">
                                        <h5 class="wishlist-title">${item.dish_name}</h5>
                                        <div class="wishlist-meta">
                                            <div class="wishlist-info">
                                                <i class="fas fa-balance-scale"></i> 
                                                <span><strong>Qty:</strong> ${item.quantity}</span>
                                            </div>
                                            <div class="wishlist-info">
                                                <i class="fas fa-tag"></i>
                                                <span><strong>Price:</strong> $${item.price}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wishlist-actions">
                                    <form method="Post" action="/delete-wishlist-item/${item.id}">
                                    @method("DELETE")
                                    @csrf
                                     <button type="button" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i> 
                                        </button>
                                    </form>
                                       
                                        <form method="POST" class="add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="wishlist_id" value="${item.id}">
                                            <input type="hidden" name="dish_id" value="${item.dish_id}">
                                            <input type="hidden" name="quantity_id" value="${item.quantity_id}">
                                            <input type="hidden" name="total_amount" value="${item.price}">
                                            <div class="d-flex justify-content-center">
                                                <div class="input-group input-group-sm m-2" style="width: 90px;height: 37px;">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm decrease-qty">−</button>
                                                    <input type="number" name="cart_quantity" class="form-control text-center cart-quantity" min="1" value="1" style="width: 30px; font-size: 14px;">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm increase-qty">+</button>
                                                </div>
                                                <button type="submit" class="btn btn-success add-to-cart-btn"><i class="fas fa-shopping-cart"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        `);
                            });

                            // Attach event listener for delete buttons (event delegation)
                            $(document).on("click", ".delete-wishlist-item", function () {
                                const itemId = $(this).data("id");
                                deleteWishlistItem(itemId);
                            });
                        } else {
                            wishlistContainer.append("<p>Your wishlist is empty.</p>");
                        }
                    },
                    error: function () {
                        alert("Failed to load wishlist items. Please try again.");
                    }
                });
            }

            // AJAX Submission for "Add to Cart"
            $(document).on("submit", ".add-to-cart-form", function (e) {
                e.preventDefault(); // Prevent default form submission
                var form = $(this);
                var formData = form.serialize();
                var wishlistItem = form.closest(".wishlist-item"); // Get the parent wishlist item

                $.ajax({
                    url: "/add-to-cart", // Change this to your actual route
                    method: "POST",
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            showNotification("success", "Success", response.message);
                            updateWishlistCount();
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

            // Function to update cart count (Assuming cart count is displayed somewhere)
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
        document.addEventListener('DOMContentLoaded', function () {
            const cartBadge = document.querySelector('.cart-badge');

            // Trigger the bounce animation every 5 seconds
            setInterval(() => {
                cartBadge.classList.add('bounce-once');
                setTimeout(() => cartBadge.classList.remove('bounce-once'), 500);
            }, 5000);
        });

        document.addEventListener('DOMContentLoaded', function () {
            const cartBadge = document.querySelector('.wishlist-badge');

            // Trigger the bounce animation every 5 seconds
            setInterval(() => {
                cartBadge.classList.add('bounce-once');
                setTimeout(() => cartBadge.classList.remove('bounce-once'), 500);
            }, 5000);
        });
    </script>
</body>

</html>