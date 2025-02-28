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


    <!-- <link rel="stylesheet" href="{{asset('admin/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/kaiadmin.min.css')}}" /> -->
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("img").forEach(img => {
                if (!img.hasAttribute("loading")) {
                    img.setAttribute("loading", "lazy");
                }
            });
        });
    </script>

    <link rel="preload" as="image" href="img/hero1.png" type="image/webp">



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
                    <h1 class="text-primary fw-bold mb-0 d-flex align-items-center">
                        <img src="{{ asset('img/logo2.png') }}" alt="PickleHouse Logo" class="me-2 img-fluid"
                            style="max-width: 100px; max-height: 100px;">
                    </h1>
                </a>

                <!-- CART ICON (Mobile View) -->
                @auth
                    <div class="cart-container d-lg-none" style="position: absolute; right: 92px; top: 62px;">
                        <a href="{{route('user.cart')}}">
                            <i class="fas fa-shopping-cart cart-icon" style="font-size: 1.7rem;"></i>
                            <span class="uk-badge cart-badge">
                                {{ auth()->check() ? \App\Models\Order::where(['user_id' => auth()->id(), 'order_stage' => 'in_cart'])->count() : 0 }}
                            </span>
                        </a>
                    </div>
                @endauth
                <!-- Messages Icon (Mobile View) -->
                @auth
                    <div class="d-lg-none" style="position: absolute; right: 70px; top: 62px;">
                        <a href="#" id="mobileMessageToggle">
                            <i class="fas fa-envelope text-primary" style="font-size: 1.7rem;"></i>
                            <span class="uk-badge cart-badge" id="messageCountMobile">0</span>
                        </a>
                        <ul class="dropdown-menu messages-notif-box animated fadeIn shadow-sm p-3"
                            id="mobileMessageDropdown" style="border-radius: 10px; display: none;">
                            <li class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                <span class="fw-bold text-dark">Messages</span>
                                <a href="#" id="markAllMessagesReadMobile" class="small text-primary">Mark all as read</a>
                            </li>
                            <li>
                                <div class="message-notif-scroll scrollbar-outer"
                                    style="max-height: 250px; overflow-y: auto;">
                                    <div class="notif-center" id="messageListMobile">
                                        <!-- Dynamic messages will be loaded here -->
                                    </div>
                                </div>
                            </li>
                            <li class="text-center border-top pt-2">
                                <a class="text-primary fw-bold" href="{{ route('user.messages') }}">
                                    See all messages <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endauth



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

                    <!-- CART ICON (Desktop View) -->
                    @auth
                        <div class="cart-container d-none d-lg-inline-block" style="position: relative;">
                            <a href="{{route('user.cart')}}">
                                <i class="fas fa-shopping-cart cart-icon" style="font-size: 1.5rem;"></i>
                                <span class="uk-badge cart-badge">
                                    {{ auth()->check() ? \App\Models\Order::where(['user_id' => auth()->id(), 'order_stage' => 'in_cart'])->count() : 0 }}
                                </span>
                            </a>
                        </div>
                    @endauth


                    <!-- Messages Dropdown (Desktop View) -->
                    @auth
                        <div class="cart-container d-none d-lg-inline-block" style="position: relative;">
                            <li class="nav-item topbar-icon dropdown hidden-caret d-none d-lg-inline-block">
                                <a class="nav-link dropdown-toggle position-relative" href="#" id="messageDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-envelope text-primary fs-4"></i>
                                    <span class="uk-badge cart-badge-2" id="messageCount">0</span>
                                </a>
                                <ul class="dropdown-menu messages-notif-box animated fadeIn shadow-sm p-3"
                                    aria-labelledby="messageDropdown" style="width: 300px; border-radius: 10px;">
                                    <li class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                        <span class="fw-bold text-dark">Messages</span>
                                        <a href="#" id="markAllMessagesRead" class="small text-primary">Mark all as read</a>
                                    </li>
                                    <li>
                                        <div class="message-notif-scroll scrollbar-outer"
                                            style="max-height: 250px; overflow-y: auto;">
                                            <div class="notif-center" id="messageList">
                                                <!-- Dynamic messages will be loaded here -->
                                            </div>
                                        </div>
                                    </li>
                                    <li class="text-center border-top pt-2">
                                        <a class="text-primary fw-bold" href="{{ route('user.messages') }}">See all messages
                                            <i class="fa fa-angle-right"></i></a>
                                    </li>
                                </ul>
                            </li>
                        </div>
                    @endauth

                    <!-- Currency Selection Dropdown -->
                    @php
                        // Get the logged-in user's country (default to INR if not logged in)
                        $userCountry = auth()->check() ? auth()->user()->country : 'INR';

                        // Get the stored session currency (if the user changed it)
                        $sessionCurrency = session('selected_currency', $userCountry);

                        // Currency flag mapping
                        $flags = [
                            'INR' => asset('img/flags/inr.png'),
                            'USD' => asset('img/flags/usd.png'),
                            'AUD' => asset('img/flags/aud.png'),
                            'CAD' => asset('img/flags/cad.png'),
                        ];

                        // Use the session currency flag (or default to user's country)
                        $selectedFlag = $flags[$sessionCurrency] ?? asset('img/flags/inr.png');
                    @endphp


                    <div class="dropdown me-4">
                        <button class="btn btn-light dropdown-toggle" type="button" id="currencyDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img id="selected-flag" src="{{ $selectedFlag }}" width="25" class="me-1" alt="flags">
                            <span id="selected-currency-text"> {{ $sessionCurrency }} </span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="currencyDropdown">
                            <li><a class="dropdown-item currency-option" href="#" data-country="INR"
                                    data-flag="{{ asset('img/flags/inr.png') }}">🇮🇳 INR</a></li>
                            <li><a class="dropdown-item currency-option" href="#" data-country="USD"
                                    data-flag="{{ asset('img/flags/usd.png') }}">🇺🇸 USD</a></li>
                            <li><a class="dropdown-item currency-option" href="#" data-country="AUD"
                                    data-flag="{{ asset('img/flags/aud.png') }}">🇦🇺 AUD</a></li>
                            <li><a class="dropdown-item currency-option" href="#" data-country="CAD"
                                    data-flag="{{ asset('img/flags/cad.png') }}">🇨🇦 CAD</a></li>
                        </ul>
                    </div>
                    <!-- end Currency Selection Dropdown -->


                    <button class="btn-search btn btn-primary btn-md-square me-4 rounded-circle d-none d-lg-inline-flex"
                        data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="Open Search">
                        <span class="visually-hidden">Search</span>
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
    <div class="container-fluid footer py-6 my-6 mb-0 bg-light">

        <div class=" row">
            <!-- Brand Info -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h1 class="text-primary">
                        Pickle<span class="text-dark">House</span>
                    </h1>
                    <p class="lh-lg mb-4">
                        Experience the Rich & Authentic Flavors of Pickles.
                    </p>
                    <div class="footer-icon d-flex">
                        <a class="btn btn-outline-primary btn-sm-square me-2 rounded-circle" href="#"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-primary btn-sm-square me-2 rounded-circle" href="#"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-primary btn-sm-square me-2 rounded-circle" href="#"><i
                                class="fab fa-instagram"></i></a>
                        <a class="btn btn-outline-primary btn-sm-square rounded-circle" href="#"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>

            <!-- Services -->
            <div class="col-lg-2 col-md-6">
                <div class="footer-item">
                    <h4 class="mb-4">We Provide</h4>
                    <div class="d-flex flex-column align-items-start">
                        <a class="text-body mb-3" href="#"><i class="fa fa-check text-primary me-2"></i>Non-veg
                            Pickles</a>
                        <a class="text-body mb-3" href="#"><i class="fa fa-check text-primary me-2"></i>Veg
                            Pickles</a>
                        <a class="text-body mb-3" href="#"><i class="fa fa-check text-primary me-2"></i>Homemade
                            Sweets</a>
                        <a class="text-body mb-3" href="#"><i class="fa fa-check text-primary me-2"></i>Special
                            Sweets</a>
                    </div>
                </div>
            </div>

            <!-- Contact -->
            <div class="col-lg-2 col-md-6">
                <div class="footer-item">
                    <h4 class="mb-4">Contact Us</h4>
                    <p><i class="fa fa-map-marker-alt text-primary me-2"></i> 123 Street, Visakhapatnam, AP</p>
                    <p><i class="fas fa-phone text-primary me-2"></i> (+091) 885544 3322</p>
                    <p><i class="fas fa-envelope text-primary me-2"></i> info@example.com</p>
                    <p><i class="fa fa-clock text-primary me-2"></i> 24/7 Hours Service</p>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-2 col-md-6">
                <div class="footer-item">
                    <h4 class="mb-4">Social Gallery</h4>
                    <div class="row g-2">
                        <div class="col-4"><img src="{{ asset('img/menu-01.jpg') }}"
                                class="img-fluid rounded-circle border border-primary p-2"></div>
                        <div class="col-4"><img src="{{ asset('img/menu-02.jpg') }}"
                                class="img-fluid rounded-circle border border-primary p-2"></div>
                        <div class="col-4"><img src="{{ asset('img/menu-03.jpg') }}"
                                class="img-fluid rounded-circle border border-primary p-2"></div>
                        <div class="col-4"><img src="{{ asset('img/menu-04.jpg') }}"
                                class="img-fluid rounded-circle border border-primary p-2"></div>
                        <div class="col-4"><img src="{{ asset('img/menu-05.jpg') }}"
                                class="img-fluid rounded-circle border border-primary p-2"></div>
                        <div class="col-4"><img src="{{ asset('img/menu-06.jpg') }}"
                                class="img-fluid rounded-circle border border-primary p-2"></div>
                    </div>
                </div>
                          
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="mb-4">Subscribe to Newsletter</h4>
                    <p>Stay updated with our latest offers and products.</p>
                    <div class="row g-2">
                        <form action="{{ route('newsletter.subscribe') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="email" class="form-control border-primary rounded-start" name="email"
                                    placeholder="Enter your email" required>
                                <button class="btn btn-primary rounded-end" type="submit" aria-label="Send Newsletter">
                                    <span class="visually-hidden">Send Newsletter</span>
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                      
        </div>
    </div>

    <!-- Footer Bottom -->

    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i
                                class="fas fa-copyright text-light me-2"></i>PickleHouse</a>, All right
                        reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
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




    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let mobileMessageToggle = document.getElementById("mobileMessageToggle");
            let mobileMessageDropdown = document.getElementById("mobileMessageDropdown");

            if (mobileMessageToggle && mobileMessageDropdown) {
                mobileMessageToggle.addEventListener("click", function (e) {
                    e.preventDefault();

                    // Toggle the dropdown visibility
                    if (mobileMessageDropdown.style.display === "none" || mobileMessageDropdown.style.display === "") {
                        mobileMessageDropdown.style.display = "block";
                    } else {
                        mobileMessageDropdown.style.display = "none";
                    }
                });

                // Close dropdown when clicking outside
                document.addEventListener("click", function (event) {
                    if (!mobileMessageToggle.contains(event.target) && !mobileMessageDropdown.contains(event.target)) {
                        mobileMessageDropdown.style.display = "none";
                    }
                });
            }
        });
    </script>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let selectedCurrencyText = document.getElementById("selected-currency-text");
            let selectedFlag = document.getElementById("selected-flag");
            let currencyOptions = document.querySelectorAll(".currency-option");

            if (!selectedCurrencyText || !selectedFlag || currencyOptions.length === 0) {
                console.error("Dropdown elements not found. Ensure your dropdown exists in the HTML.");
                return;
            }

            // Get stored session currency (from backend-rendered HTML)
            let storedCurrency = "{{ $sessionCurrency }}";
            let storedFlag = "{{ $selectedFlag }}";

            // Update UI with stored values
            selectedCurrencyText.textContent = storedCurrency;
            selectedFlag.src = storedFlag;

            // Add event listeners for currency selection
            currencyOptions.forEach(option => {
                option.addEventListener("click", function (e) {
                    e.preventDefault();

                    let selectedCurrency = this.getAttribute("data-country");
                    let selectedFlagUrl = this.getAttribute("data-flag");

                    if (!selectedCurrency || !selectedFlagUrl) {
                        console.error("Missing currency or flag attributes.");
                        return;
                    }

                    // Update UI immediately
                    selectedCurrencyText.textContent = selectedCurrency;
                    selectedFlag.src = selectedFlagUrl;

                    // Save in localStorage
                    localStorage.setItem("selectedCurrency", selectedCurrency);
                    localStorage.setItem("selectedFlag", selectedFlagUrl);

                    // Make AJAX request to update session
                    fetch("{{ route('set.currency') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({ currency: selectedCurrency })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log("Currency updated in session:", selectedCurrency);
                                location.reload(); // Refresh to apply conversion
                            }
                        })
                        .catch(error => console.error("Error updating session:", error));
                });
            });
        });

    </script>


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
            $(document).ready(function () {
                var toggle_customSidebar = false,
                    custom_open = 0;

                if (!toggle_customSidebar) {
                    var toggle = $('.custom-template .custom-toggle');
                    var customTemplate = $('.custom-template');

                    toggle.on('click', function (event) {
                        event.stopPropagation(); // Prevent click event from bubbling up
                        if (custom_open === 1) {
                            customTemplate.removeClass('open');
                            toggle.removeClass('toggled');
                            custom_open = 0;
                        } else {
                            customTemplate.addClass('open');
                            toggle.addClass('toggled');
                            custom_open = 1;
                            fetchWishlistItems();
                        }
                    });

                    // Click outside to close
                    $(document).on("click", function (event) {
                        if (custom_open === 1 && !$(event.target).closest('.custom-template').length) {
                            customTemplate.removeClass('open');
                            toggle.removeClass('toggled');
                            custom_open = 0;
                        }
                    });

                    toggle_customSidebar = true;
                }
            });


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
                                                                        <div class="cart__punit hide-mobile">
                                                        <span
                                                            class="jsPrice">${item.discount_price}</span>


                                                        <h4
                                                            class="cart__compare-price cart__compare-price--punit jsPrice text-primary price-display">${item.original_price}
                                                           </h4>

                                                    </div>

                                          
                                        </div>
                                    </div>
                                    <div class="wishlist-actions">
                                    <form method="Post" action="/delete-wishlist-item/${item.id}">
                                    @method("DELETE")
                                    @csrf
                                     <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i> 
                                        </button>
                                    </form>
                                       
                                        <form method="POST" class="add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="wishlist_id" value="${item.id}">
                                            <input type="hidden" name="dish_id" value="${item.dish_id}">
                                            <input type="hidden" name="quantity_id" value="${item.quantity_id}">
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
            const cartBadges = document.querySelectorAll('.cart-badge'); // Select all instances

            if (cartBadges.length > 0) {
                setInterval(() => {
                    cartBadges.forEach((badge) => {
                        badge.classList.add('bounce-once');
                        setTimeout(() => badge.classList.remove('bounce-once'), 500);
                    });
                }, 5000);
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const cartBadges2 = document.querySelectorAll('.cart-badge-2'); // Select all instances

            if (cartBadges2.length > 0) {
                setInterval(() => {
                    cartBadges2.forEach((badge) => {
                        badge.classList.add('bounce-once');
                        setTimeout(() => badge.classList.remove('bounce-once'), 500);
                    });
                }, 5000);
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const cartBadge = document.querySelector('.wishlist-badge');

            if (cartBadge) { // Check if element exists
                setInterval(() => {
                    cartBadge.classList.add('bounce-once');
                    setTimeout(() => cartBadge.classList.remove('bounce-once'), 500);
                }, 5000);
            }
        });
    </script>


    <audio id="notificationSound" src="{{ asset('sounds/notification.mp3') }}"="auto"></audio>

    @auth
        <script>
            let lastUnreadCount = 0; // Store the last unread count

            function fetchMessages() {
                fetch("{{ route('notifications.messages') }}")
                    .then(response => response.json())
                    .then(data => {
                        let messageList = document.getElementById('messageList');
                        let messageListMobile = document.getElementById('messageListMobile');
                        let messageCount = document.getElementById('messageCount');
                        let messageCountMobile = document.getElementById('messageCountMobile');

                        messageList.innerHTML = "";
                        messageListMobile.innerHTML = "";
                        let unreadCount = 0;

                        data.forEach(notification => {
                            if (!notification.read_at) { // Only count unread messages
                                unreadCount++;
                            }

                            let messageItem = `
                                                                                                        <a href="{{ url('/support-tickets/') }}/${notification.data.ticket_id}" class="d-flex align-items-center p-2 border-bottom text-dark text-decoration-none">
                                                                                                            <div class="notif-content">
                                                                                                                <span class="fw-bold">${notification.data.username}</span>
                                                                                                                <span class="d-block small text-muted">${notification.data.message}</span>
                                                                                                                <span class="small text-muted">${new Date(notification.created_at).toLocaleTimeString()}</span>
                                                                                                            </div>
                                                                                                        </a>
                                                                                                    `;

                            messageList.innerHTML += messageItem;
                            messageListMobile.innerHTML += messageItem;
                        });

                        // Update the count based on unread messages
                        if (messageCount) messageCount.textContent = unreadCount > 0 ? unreadCount : 0;
                        if (messageCountMobile) messageCountMobile.textContent = unreadCount > 0 ? unreadCount : 0;

                        // If there are new messages, play the notification sound
                        if (unreadCount > lastUnreadCount) {
                            playNotificationSound();
                        }

                        lastUnreadCount = unreadCount;
                    })
                    .catch(error => console.error("Error fetching messages:", error));
            }

            function playNotificationSound() {
                let audio = document.getElementById("notificationSound");
                if (audio) {
                    audio.play().catch(error => console.error("Audio play error:", error));
                }
            }

            document.addEventListener("DOMContentLoaded", function () {
                fetchMessages();
                setInterval(fetchMessages, 5000); // Auto-refresh every 5 seconds
            });

            // Mark all messages as read when the user clicks "See All Messages"
            document.getElementById('markAllMessagesRead').addEventListener('click', function () {
                fetch("{{ route('notifications.markAllRead') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    }
                }).then(() => {
                    fetchMessages(); // Refresh after marking as read
                });
            });

            document.getElementById('markAllMessagesReadMobile').addEventListener('click', function () {
                fetch("{{ route('notifications.markAllRead') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    }
                }).then(() => {
                    fetchMessages();
                });
            });
        </script>
    @endauth





</body>

</html>