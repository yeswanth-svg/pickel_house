@extends('layouts.app')
@section('title', 'Pickel House')
@section('content')

    <style>
        /* Menu Item */
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
        .menu-item .img-responsive {
            width: 150px;
            object-fit: cover;
            position: relative;
            /* Prevents image shrinking */
        }

        /* Responsive Adjustments */
        /* Desktop View - Categories Side by Side */
        .category-tabs {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            white-space: nowrap;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            padding-bottom: 10px;
            justify-content: center;
        }

        .category-tabs::-webkit-scrollbar {
            display: none;
        }

        .nav-item {
            flex: 0 0 auto;
            scroll-snap-align: start;
            margin-right: 10px;
        }

        .dish-card {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .dish-card:hover {
            transform: scale(1.02);
        }

        /* Make sure the button appears properly */
        .dish-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        /* Darken the background on hover */
        /* Darken background on hover */
        .overlay-effect {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Dark overlay */
            border-radius: 10px;
        }

        /* Show View Button */
        .view-button {
            z-index: 2;
            position: relative;
        }

        /* View Button should appear on hover (desktop) & touch (mobile) */
        .dish-card:hover .dish-overlay {
            opacity: 1;
        }

        .dish-card {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .dish-card:hover {
            transform: scale(1.02);
        }

        /* Overlay Effect (Hidden on Mobile) */
        .d-none.d-md-block {
            display: none !important;
            /* Hide overlay on mobile */
        }

        @media (min-width: 768px) {

            /* Desktop styles */
            .d-none.d-md-block {
                display: block !important;
                /* Show overlay on desktop */
            }

            .dish-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                text-decoration: none;
                opacity: 0;
                transition: opacity 0.3s ease-in-out;
            }

            .overlay-effect {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                /* Dark overlay */
                border-radius: 10px;
            }

            .dish-card:hover .dish-overlay {
                opacity: 1;
            }
        }

        /* View Button (Always Visible on Mobile) */
        .view-button {
            z-index: 2;
            position: relative;
            text-align: center;
            font-size: 14px;
        }

        /* Ensure View Button is always visible on mobile */
        .d-inline.d-md-none {
            display: inline-block !important;
        }




        /* Mobile View - Side Scroll */
        @media (max-width: 768px) {
            .category-tabs {
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
                scroll-snap-type: x mandatory;
                -webkit-overflow-scrolling: touch;
                padding-bottom: 10px;
                scroll-padding-left: 15px;
                /* Ensures first category is visible */
                padding-left: 15px;
                justify-content: normal;
                /* Prevents cutoff */
            }

            .nav-item {
                flex: 0 0 auto;
                /* Prevent items from shrinking */
                scroll-snap-align: start;
            }

            .nav-item:first-child {
                margin-left: 5px;
                /* Ensures the first item is visible */
            }

            /* Hide scrollbar but allow smooth scrolling */
            .category-tabs::-webkit-scrollbar {
                display: none;
            }

            .category-tabs {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        }
    </style>


    <!-- Hero Start -->
    <div class="container-fluid bg-light py-6 my-6 mt-0">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-7 col-md-12">
                    <h1 class="display-2 mb-4">
                        <span style="color: black">Authentic</span>
                        <span class="text-primary">Experience the Rich & Authentic</span>
                        Flavors of Pickles
                    </h1>
                    <div class="d-flex justify-content-start align-items-start">
                        <a href="{{ route('menu')}}" class="btn btn-primary border-0 rounded-pill py-3  px-md-5 me-4">Order
                            Now</a>
                        <a href="#welcome_menu" class="btn btn-primary border-0 rounded-pill py-3  px-md-5">Explore
                            Flavors</a>
                    </div>

                </div>
                <div class="col-lg-5 col-md-12">
                    <img src="img/hero1.png" class="img-fluid rounded " alt="Delicious Pickles" />
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="container-fluid py-6">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <img src="img/about1.png" class="img-fluid rounded" alt="Traditional Pickles" />
                </div>
                <div class="col-lg-7" data-wow-delay="0.3s">
                    <small
                        class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">About
                        Us</small>
                    <h1 class="display-5 mb-4">
                        Bringing Authentic Homemade Pickles to You
                    </h1>
                    <p class="mb-4">
                        Our journey began with a passion for preserving traditional
                        flavors passed down through generations. Using time-honored
                        recipes and handpicked ingredients, we craft each jar of pickle
                        with love and authenticity. Every bite is a taste of tradition,
                        made just like home.
                    </p>
                    <div class="row g-4 text-dark mb-5">
                        <div class="col-sm-6">
                            <i class="fas fa-seedling text-primary me-2"></i>Made with
                            Handpicked Ingredients
                        </div>
                        <div class="col-sm-6">
                            <i class="fas fa-leaf text-primary me-2"></i>Authentic &
                            Traditional Recipes
                        </div>
                        <div class="col-sm-6">
                            <i class="fas fa-hand-holding-heart text-primary me-2"></i>Homemade with Love & Care
                        </div>
                        <div class="col-sm-6">
                            <i class="fas fa-star text-primary me-2"></i>Rich & Bold Flavors
                            in Every Bite
                        </div>
                    </div>
                    <a href="" class="btn btn-primary py-3 px-5 rounded-pill">Know More <i
                            class="fas fa-arrow-right ps-2"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Fact Start-->
    <div class="container-fluid faqt py-6">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-7">
                    <div class="row g-4">
                        <div class="col-sm-4" data-wow-delay="0.3s">
                            <div class="faqt-item bg-primary rounded p-4 text-center">
                                <i class="fas fa-users fa-4x mb-4 text-white"></i>
                                <h1 class="display-4 fw-bold" data-toggle="counter-up">
                                    689
                                </h1>
                                <p class="text-dark text-uppercase fw-bold mb-0">
                                    Happy Customers
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-4" data-wow-delay="0.5s">
                            <div class="faqt-item bg-primary rounded p-4 text-center">
                                <i class="fas fa-users-cog fa-4x mb-4 text-white"></i>
                                <h1 class="display-4 fw-bold" data-toggle="counter-up">8</h1>
                                <p class="text-dark text-uppercase fw-bold mb-0">
                                    Expert Chefs
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-4" data-wow-delay="0.7s">
                            <div class="faqt-item bg-primary rounded p-4 text-center">
                                <i class="fas fa-check fa-4x mb-4 text-white"></i>
                                <h1 class="display-4 fw-bold" data-toggle="counter-up">
                                    253
                                </h1>
                                <p class="text-dark text-uppercase fw-bold mb-0">
                                    Deliveries
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="video">
                        <button type="button" class="btn btn-play" data-bs-toggle="modal" data-src="img/hero12.mp4"
                            data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Video -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">pickle house</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                            allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact End -->

    <!-- Menu Start -->
    <div class="container-fluid menu py-6" id="welcome_menu">
        <div class="text-center">
            <small
                class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">
                Our Menu
            </small>
            <h1 class="display-5 mb-5">Most Loved Pickles & Traditional Sweets Around the World</h1>
        </div>

        <div class="tab-class text-center">
            <!-- Category Tabs -->
            <ul class="nav nav-pills d-flex category-tabs mb-5">
                @foreach($categories as $key => $category)
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 border border-primary bg-white rounded-pill category-tab {{ $key === 0 ? 'active' : '' }}"
                            data-bs-toggle="pill" href="#tab-{{ $category->id }}">
                            {{ $category->category_name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach($categories as $key => $category)
                    <div id="tab-{{ $category->id }}" class="tab-pane fade show p-0 @if($key === 0) active @endif">
                        <div class="row g-4">
                            @foreach($category->dishes as $dish)
                                <div class="col-lg-6">
                                    <!-- Dish Card with Hover Effect -->
                                    <!-- Dish Card with Mobile-Friendly View Button -->
                                    <div class="menu-item d-flex align-items-center position-relative dish-card">
                                        <a href="{{ route('dish.details', $dish->id) }}" class="dish-overlay">
                                            <div class="overlay-effect d-none d-md-block"></div> <!-- Only visible on desktop -->
                                            <span class="view-button btn btn-primary btn-sm d-inline d-md-none">View</span>
                                            <!-- Always visible on mobile -->
                                        </a>

                                        <!-- Dish Image -->
                                        <div class="ratio ratio-1x1 img-responsive">
                                            <img src="{{ asset('dish_images/' . $dish->image) }}" alt="{{ $dish->name }}"
                                                class="img-fluid rounded dish-img" />
                                        </div>

                                        <!-- Dish Details -->
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h4>{{ $dish->name }}</h4>
                                            <!-- Rating -->
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
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Menu End -->

    <!-- Team Start -->
    <div class="container-fluid team py-6">
        <div class="container">
            <div class="text-center">
                <small
                    class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Our
                    Team</small>
                <h1 class="display-5 mb-5">We have experienced chef Team</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="team-item rounded">
                        <img class="img-fluid rounded-top" src="img/chef1.jpg" alt="" />
                        <div class="team-content text-center py-3 bg-danger rounded-bottom">
                            <h4 class="text-light">Chef 1</h4>
                            <p class="text-white mb-0">Professional Chef</p>
                        </div>
                        <div class="team-icon d-flex flex-column justify-content-center m-4">
                            <a class="share btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fas fa-share-alt"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-wow-delay="0.3s">
                    <div class="team-item rounded">
                        <img class="img-fluid rounded-top" src="img/chef2.jpg" alt="" />
                        <div class="team-content text-center py-3 bg-danger rounded-bottom">
                            <h4 class="text-light">Chef 2</h4>
                            <p class="text-white mb-0">Professional Chef</p>
                        </div>
                        <div class="team-icon d-flex flex-column justify-content-center m-4">
                            <a class="share btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fas fa-share-alt"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-wow-delay="0.5s">
                    <div class="team-item rounded">
                        <img class="img-fluid rounded-top" src="img/chef3.jpg" alt="" />
                        <div class="team-content text-center py-3 bg-danger rounded-bottom">
                            <h4 class="text-light">Chef 3</h4>
                            <p class="text-white mb-0">Professional Chef</p>
                        </div>
                        <div class="team-icon d-flex flex-column justify-content-center m-4">
                            <a class="share btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fas fa-share-alt"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-wow-delay="0.7s">
                    <div class="team-item rounded">
                        <img class="img-fluid rounded-top" src="img/chef4.jpg" alt="" />
                        <div class="team-content text-center py-3 bg-danger rounded-bottom">
                            <h4 class="text-light">Chef 4</h4>
                            <p class="text-white mb-0">Professional Chef</p>
                        </div>
                        <div class="team-icon d-flex flex-column justify-content-center m-4">
                            <a class="share btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fas fa-share-alt"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="share-link btn btn-primary btn-md-square rounded-circle mb-2" href=""><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

    <!-- Testimonial Start -->
    <div class="container-fluid py-6">
        <div class="container">
            <div class="text-center">
                <small
                    class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Customer
                    Reviews</small>
                <h1 class="display-5 mb-5">What Our Customers says!</h1>
            </div>
            <div class="owl-carousel owl-theme testimonial-carousel testimonial-carousel-1 mb-4">
                <div class="testimonial-item rounded bg-light">
                    <div class="d-flex mb-3">
                        <img src="img/testimonial-1.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="" />
                        <div class="position-absolute" style="top: 15px; right: 20px">
                            <i class="fa fa-quote-right fa-2x"></i>
                        </div>
                        <div class="ps-3 my-auto">
                            <h4 class="mb-0">Person Name</h4>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">
                            Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore
                            et dolore magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="testimonial-item rounded bg-light">
                    <div class="d-flex mb-3">
                        <img src="img/testimonial-2.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="" />
                        <div class="position-absolute" style="top: 15px; right: 20px">
                            <i class="fa fa-quote-right fa-2x"></i>
                        </div>
                        <div class="ps-3 my-auto">
                            <h4 class="mb-0">Person Name</h4>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">
                            Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore
                            et dolore magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="testimonial-item rounded bg-light">
                    <div class="d-flex mb-3">
                        <img src="img/testimonial-3.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="" />
                        <div class="position-absolute" style="top: 15px; right: 20px">
                            <i class="fa fa-quote-right fa-2x"></i>
                        </div>
                        <div class="ps-3 my-auto">
                            <h4 class="mb-0">Person Name</h4>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">
                            Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore
                            et dolore magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="testimonial-item rounded bg-light">
                    <div class="d-flex mb-3">
                        <img src="img/testimonial-4.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="" />
                        <div class="position-absolute" style="top: 15px; right: 20px">
                            <i class="fa fa-quote-right fa-2x"></i>
                        </div>
                        <div class="ps-3 my-auto">
                            <h4 class="mb-0">Person Name</h4>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">
                            Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore
                            et dolore magna aliqua.
                        </p>
                    </div>
                </div>
            </div>
            <div class="owl-carousel testimonial-carousel testimonial-carousel-2" data-wow-delay="0.3s">
                <div class="testimonial-item rounded bg-light">
                    <div class="d-flex mb-3">
                        <img src="img/testimonial-1.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="" />
                        <div class="position-absolute" style="top: 15px; right: 20px">
                            <i class="fa fa-quote-right fa-2x"></i>
                        </div>
                        <div class="ps-3 my-auto">
                            <h4 class="mb-0">Person Name</h4>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">
                            Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore
                            et dolore magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="testimonial-item rounded bg-light">
                    <div class="d-flex mb-3">
                        <img src="img/testimonial-2.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="" />
                        <div class="position-absolute" style="top: 15px; right: 20px">
                            <i class="fa fa-quote-right fa-2x"></i>
                        </div>
                        <div class="ps-3 my-auto">
                            <h4 class="mb-0">Person Name</h4>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">
                            Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore
                            et dolore magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="testimonial-item rounded bg-light">
                    <div class="d-flex mb-3">
                        <img src="img/testimonial-3.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="" />
                        <div class="position-absolute" style="top: 15px; right: 20px">
                            <i class="fa fa-quote-right fa-2x"></i>
                        </div>
                        <div class="ps-3 my-auto">
                            <h4 class="mb-0">Person Name</h4>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">
                            Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore
                            et dolore magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="testimonial-item rounded bg-light">
                    <div class="d-flex mb-3">
                        <img src="img/testimonial-4.jpg" class="img-fluid rounded-circle flex-shrink-0" alt="" />
                        <div class="position-absolute" style="top: 15px; right: 20px">
                            <i class="fa fa-quote-right fa-2x"></i>
                        </div>
                        <div class="ps-3 my-auto">
                            <h4 class="mb-0">Person Name</h4>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">
                            Lorem ipsum dolor sit amet elit, sed do eiusmod tempor ut labore
                            et dolore magna aliqua.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

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