@extends('layouts.app')
@section('title', 'Pickel House')
@section('content')

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
                        <a href="" class="btn btn-primary border-0 rounded-pill py-3  px-md-5 me-4">Order
                            Now</a>
                        <a href="" class="btn btn-primary border-0 rounded-pill py-3  px-md-5">Explore
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
    <div class="container-fluid menu py-6">
        <div class="container">
            <div class="text-center">
                <small
                    class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">
                    Our Menu
                </small>
                <h1 class="display-5 mb-5">Most Loved Pickles & Traditional Sweets Around the World</h1>
            </div>
            <div class="tab-class text-center">
                <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                    @foreach($categories as $key => $category)
                        <li class="nav-item p-2">
                            <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill category-tab"
                                data-bs-toggle="pill" href="#tab-{{ $category->id }}" data-category-id="{{ $category->id }}"
                                @if($key === 0) class="active" @endif>
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
                                    <div class="col-lg-6">
                                        <div class="menu-item d-flex align-items-center">
                                            <img class="flex-shrink-0 img-fluid rounded-circle"
                                                src="{{ asset('dish_images/' . $dish->image) }}" alt="{{ $dish->name }}" />

                                            <div class="w-100 d-flex flex-column text-start ps-4">

                                                <!-- Dish Name & Quantity Selector -->
                                                <h4 class="d-flex align-items-center">
                                                    {{ $dish->name }}

                                                </h4>
                                                <div
                                                    class="d-flex align-items-center justify-content-between border-bottom border-primary pb-2 mb-2 mt-2">
                                                    @if($dish->quantities->isNotEmpty())
                                                        <select class="quantity-selector ms-2 small-select form-select form-select-sm"
                                                            data-dish-id="{{ $dish->id }}">
                                                            @foreach($dish->quantities as $q)
                                                                <option value="{{ $q->id }}"
                                                                    data-price="{{convertPrice($q->discount_price) }}"
                                                                    data-normal-price="{{$q->discount_price}}">
                                                                    {{ $q->weight }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    @endif

                                                    @auth
                                                        @if($dish->quantities->isNotEmpty())
                                                            <div class="d-flex align-items-center">
                                                                <!-- Wishlist Button -->
                                                                <form id="add-to-wishlist-form-{{ $dish->id }}"
                                                                    class="add-to-wishlist-form me-2">
                                                                    @csrf
                                                                    <input type="hidden" name="dish_id" value="{{ $dish->id }}">
                                                                    <input type="hidden" name="quantity_id" class="quantity-input1"
                                                                        value="{{ $dish->quantities->first()->id }}">
                                                                    <input type="hidden" name="total_amount" class="price-input1"
                                                                        value="{{ $dish->quantities->first()->original_price }}">

                                                                    <button type="button"
                                                                        class="btn btn-outline-warning btn-sm add-to-wishlist"
                                                                        data-dish-id="{{ $dish->id }}" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top" title="Add to Wishlist">
                                                                        <i class="fas fa-shopping-basket"></i>
                                                                    </button>
                                                                </form>

                                                                <!-- Add to Cart Form -->
                                                                <form id="add-to-cart-form-{{$dish->id}}"
                                                                    class="add-to-cart-form d-flex align-items-center">
                                                                    @csrf
                                                                    <input type="hidden" name="dish_id" value="{{ $dish->id }}">
                                                                    <input type="hidden" name="quantity_id" class="quantity-input2"
                                                                        value="{{ $dish->quantities->first()->id }}">
                                                                    <!-- Cart Quantity Counter (Styled) -->
                                                                    <div class="input-group input-group-sm me-2" style="width: 100px;">
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary btn-sm decrease-qty">−</button>
                                                                        <input type="number" name="cart_quantity"
                                                                            class="form-control text-center cart-quantity" min="1" value="1"
                                                                            style="width: 29px; font-size: 14px;">
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary btn-sm increase-qty">+</button>
                                                                    </div>

                                                                    <button type="button" class="btn btn-primary btn-sm add-to-cart"
                                                                        data-dish-id="{{ $dish->id }}" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top" title="Add to Cart">
                                                                        <i class="fas fa-shopping-cart"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        @else
                                                            <p class="text-danger">No available quantities</p>
                                                        @endif
                                                    @endauth
                                                    <div class="cart__punit hide-mobile">
                                                        <span
                                                            class="jsPrice">{{ convertPrice($dish->quantities->first()->discount_price ?? 0) }}</span>


                                                        <h4
                                                            class="cart__compare-price cart__compare-price--punit jsPrice text-primary price-display">
                                                            {{ convertPrice($dish->quantities->first()->original_price) }}
                                                        </h4>

                                                    </div>

                                                </div>
                                                <!-- 
                                                                                                                                                                                                                                                                                                                    <p class="mb-0">{{ $dish->description }}</p> -->
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

@endsection