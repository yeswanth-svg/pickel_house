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
                            'status' => 'cart'
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



    <script>
        $(document).ready(function () {
            function showNotification(type, title, message) {
                $.notify({
                    icon: type === "success" ? "fa fa-check-circle" : "fa fa-exclamation-circle",
                }, {
                    type: type,
                    allow_dismiss: false, // Removes close button
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
                        <span data-notify="icon" style="font-size: 18px;"></span> <strong style="font-size: 14px;">${title}</strong><br>
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

            // Success Notification
            @if(session('success'))
                showNotification("success", "Success", "{{ session('success') }}");
            @endif

            // Error Notification
            @if($errors->any())
                showNotification("danger", "Error", "{{ $errors->first() }}");
            @endif
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
    </script>
</body>

</html>