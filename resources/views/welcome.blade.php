@extends('layouts.app')
@section('title', 'Pickel House')

@section('content')


<!-- Hero Start -->
<div class="container-fluid bg-light py-6 my-6 mt-0">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7 col-md-12">
                <h1 class="display-1 mb-4 animated bounceInDown">
                    <span style="color: black">Authentic</span>
                    <span class="text-primary">Experience the Rich & Authentic</span>
                    Flavors of Pickles
                </h1>
                <a href=""
                    class="btn btn-primary border-0 rounded-pill py-3 px-4 px-md-5 me-4 animated bounceInLeft">Order
                    Now</a>
                <a href="" class="btn btn-primary border-0 rounded-pill py-3 px-4 px-md-5 animated bounceInLeft">Explore
                    Flavors</a>
            </div>
            <div class="col-lg-5 col-md-12">
                <img src="img/hero1.png" class="img-fluid rounded animated zoomIn" alt="Delicious Pickles" />
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- About Start -->
<div class="container-fluid py-6">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5 wow bounceInUp" data-wow-delay="0.1s">
                <img src="img/about1.png" class="img-fluid rounded" alt="Traditional Pickles" />
            </div>
            <div class="col-lg-7 wow bounceInUp" data-wow-delay="0.3s">
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
                    <div class="col-sm-4 wow bounceInUp" data-wow-delay="0.3s">
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
                    <div class="col-sm-4 wow bounceInUp" data-wow-delay="0.5s">
                        <div class="faqt-item bg-primary rounded p-4 text-center">
                            <i class="fas fa-users-cog fa-4x mb-4 text-white"></i>
                            <h1 class="display-4 fw-bold" data-toggle="counter-up">8</h1>
                            <p class="text-dark text-uppercase fw-bold mb-0">
                                Expert Chefs
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4 wow bounceInUp" data-wow-delay="0.7s">
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
            <div class="col-lg-5 wow bounceInUp" data-wow-delay="0.1s">
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
        <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
            <small
                class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Our
                Menu</small>
            <h1 class="display-5 mb-5">
                Most Loved Pickles & Traditional Sweets Around the World
            </h1>
        </div>
        <div class="tab-class text-center">
            <ul class="nav nav-pills d-inline-flex justify-content-center mb-5 wow bounceInUp" data-wow-delay="0.1s">
                <li class="nav-item p-2">
                    <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill active" data-bs-toggle="pill"
                        href="#tab-6">
                        <span class="text-dark" style="width: 150px">Non-veg</span>
                    </a>
                </li>
                <li class="nav-item p-2">
                    <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill" data-bs-toggle="pill"
                        href="#tab-7">
                        <span class="text-dark" style="width: 150px">veg</span>
                    </a>
                </li>
                <li class="nav-item p-2">
                    <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill" data-bs-toggle="pill"
                        href="#tab-8">
                        <span class="text-dark" style="width: 150px">Sweets</span>
                    </a>
                </li>
                <li class="nav-item p-2">
                    <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill" data-bs-toggle="pill"
                        href="#tab-9">
                        <span class="text-dark" style="width: 150px">Our Specials</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-6" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-6 wow bounceInUp" data-wow-delay="0.1s">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-01.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Chicken Pickle</h4>
                                        <h4 class="text-primary">$120</h4>
                                    </div>
                                    <p class="mb-0">
                                        A spicy, tangy chicken pickle made with mustard oil and
                                        aromatic spices. Perfect with rice or paratha, it adds
                                        bold flavor to your meals.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 wow bounceInUp" data-wow-delay="0.2s">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-02.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Mutton Pickle</h4>
                                        <h4 class="text-primary">$120</h4>
                                    </div>
                                    <p class="mb-0">
                                        A flavorful combination of tender mutton with a perfect
                                        blend of spices, creating a rich and aromatic pickle
                                        experience.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 wow bounceInUp" data-wow-delay="0.3s">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-03.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Prawns Pickle</h4>
                                        <h4 class="text-primary">$120</h4>
                                    </div>
                                    <p class="mb-0">
                                        A savory blend of tender prawns infused with aromatic
                                        spices and tangy flavors, making it a perfect companion
                                        for rice or bread.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 wow bounceInUp" data-wow-delay="0.4s">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-04.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Fish Pickle</h4>
                                        <h4 class="text-primary">$130</h4>
                                    </div>
                                    <p class="mb-0">
                                        A delectable combination of tender fish pieces,
                                        marinated with bold spices and tangy ingredients for a
                                        perfect pickle experience.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab-7" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-05.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Mango Pickle</h4>
                                        <h4 class="text-primary">$90</h4>
                                    </div>
                                    <p class="mb-0">
                                        A tangy and spicy pickle made with raw mangoes, mustard
                                        oil, and a blend of traditional Indian spices. Perfect
                                        for adding zest to any meal.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-06.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Lemon Pickle</h4>
                                        <h4 class="text-primary">$90</h4>
                                    </div>
                                    <p class="mb-0">
                                        A tangy, zesty pickle made with fresh lemons, mustard
                                        oil, and a mix of spices. Perfect for adding a burst of
                                        flavor to your meals.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-07.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Gongura Pickle</h4>
                                        <h4 class="text-primary">$90</h4>
                                    </div>
                                    <p class="mb-0">
                                        A tangy and flavorful pickle made with Gongura leaves,
                                        mustard oil, and a blend of spices. Known for its unique
                                        sour taste, it's a favorite in South India.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-08.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Tomato Pickle</h4>
                                        <h4 class="text-primary">$90</h4>
                                    </div>
                                    <p class="mb-0">
                                        A tangy and spicy pickle made with ripe tomatoes,
                                        mustard oil, and a special blend of Indian spices. A
                                        perfect side dish for rice or flatbreads.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-09.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Mixed Vegetable Pickle</h4>
                                        <h4 class="text-primary">$90</h4>
                                    </div>
                                    <p class="mb-0">
                                        A flavorful mix of carrots, cauliflower, and green
                                        beans, marinated in mustard oil with a blend of
                                        traditional spices. A perfect accompaniment to any meal.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-10.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Ginger Pickle</h4>
                                        <h4 class="text-primary">$90</h4>
                                    </div>
                                    <p class="mb-0">
                                        A zesty pickle made with fresh ginger, jaggery, and a
                                        blend of spices, offering a perfect balance of sweet and
                                        spicy flavors. Ideal for enhancing any meal.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab-8" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-11.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Pootharekulu</h4>
                                        <h4 class="text-primary">$70</h4>
                                    </div>
                                    <p class="mb-0">
                                        A sweet made from thin, crispy rice starch sheets filled
                                        with a mixture of sugar, ghee, and cardamom.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-12.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Ariselu (Indian Rice Cakes)</h4>
                                        <h4 class="text-primary">$80</h4>
                                    </div>
                                    <p class="mb-0">
                                        Made from rice flour, jaggery, and sesame seeds,
                                        deep-fried to form golden, crisp cakes.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-13.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Puran Poli (Bobbatlu)</h4>
                                        <h4 class="text-primary">$100</h4>
                                    </div>
                                    <p class="mb-0">
                                        A flatbread stuffed with a sweet filling of chana dal,
                                        jaggery, and cardamom, and served with ghee.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-14.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Kaja</h4>
                                        <h4 class="text-primary">$90</h4>
                                    </div>
                                    <p class="mb-0">
                                        Deep-fried dough soaked in sugar syrup, giving it a
                                        crispy texture on the outside and a soft interior.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-15.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Gavvalu (Shell-shaped Sweet)</h4>
                                        <h4 class="text-primary">$75</h4>
                                    </div>
                                    <p class="mb-0">
                                        Fried, shell-shaped dumplings made of flour, ghee, and
                                        sugar syrup.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-16.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Kobbari Louz (Coconut Sweet)</h4>
                                        <h4 class="text-primary">$85</h4>
                                    </div>
                                    <p class="mb-0">
                                        A coconut-based sweet prepared by combining grated
                                        coconut and sugar, cooked to a fudge-like consistency.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-17.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Laddu</h4>
                                        <h4 class="text-primary">$90</h4>
                                    </div>
                                    <p class="mb-0">
                                        A popular sweet made from chickpea flour, ghee, sugar,
                                        and cardamom, shaped into round balls and garnished with
                                        cashews or almonds.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-18.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Sunnuda</h4>
                                        <h4 class="text-primary">$85</h4>
                                    </div>
                                    <p class="mb-0">
                                        A traditional sweet made from rice flour, jaggery, and
                                        ghee, shaped into round or oval forms and often flavored
                                        with cardamom.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab-9" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-11.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Pootharekulu</h4>
                                        <h4 class="text-primary">$70</h4>
                                    </div>
                                    <p class="mb-0">
                                        A sweet made from thin, crispy rice starch sheets filled
                                        with a mixture of sugar, ghee, and cardamom.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-12.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Ariselu (Indian Rice Cakes)</h4>
                                        <h4 class="text-primary">$80</h4>
                                    </div>
                                    <p class="mb-0">
                                        Made from rice flour, jaggery, and sesame seeds,
                                        deep-fried to form golden, crisp cakes.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-13.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Puran Poli (Bobbatlu)</h4>
                                        <h4 class="text-primary">$100</h4>
                                    </div>
                                    <p class="mb-0">
                                        A flatbread stuffed with a sweet filling of chana dal,
                                        jaggery, and cardamom, and served with ghee.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-14.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Kaja</h4>
                                        <h4 class="text-primary">$90</h4>
                                    </div>
                                    <p class="mb-0">
                                        Deep-fried dough soaked in sugar syrup, giving it a
                                        crispy texture on the outside and a soft interior.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-15.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Gavvalu (Shell-shaped Sweet)</h4>
                                        <h4 class="text-primary">$75</h4>
                                    </div>
                                    <p class="mb-0">
                                        Fried, shell-shaped dumplings made of flour, ghee, and
                                        sugar syrup.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-16.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Kobbari Louz (Coconut Sweet)</h4>
                                        <h4 class="text-primary">$85</h4>
                                    </div>
                                    <p class="mb-0">
                                        A coconut-based sweet prepared by combining grated
                                        coconut and sugar, cooked to a fudge-like consistency.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-17.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Laddu</h4>
                                        <h4 class="text-primary">$90</h4>
                                    </div>
                                    <p class="mb-0">
                                        A popular sweet made from chickpea flour, ghee, sugar,
                                        and cardamom, shaped into round balls and garnished with
                                        cashews or almonds.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="menu-item d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded-circle" src="img/menu-18.jpg" alt="" />
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                        <h4>Sunnuda</h4>
                                        <h4 class="text-primary">$85</h4>
                                    </div>
                                    <p class="mb-0">
                                        A traditional sweet made from rice flour, jaggery, and
                                        ghee, shaped into round or oval forms and often flavored
                                        with cardamom.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Menu End -->



<!-- Team Start -->
<div class="container-fluid team py-6">
    <div class="container">
        <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
            <small
                class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Our
                Team</small>
            <h1 class="display-5 mb-5">We have experienced chef Team</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 wow bounceInUp" data-wow-delay="0.1s">
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
            <div class="col-lg-3 col-md-6 wow bounceInUp" data-wow-delay="0.3s">
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
            <div class="col-lg-3 col-md-6 wow bounceInUp" data-wow-delay="0.5s">
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
            <div class="col-lg-3 col-md-6 wow bounceInUp" data-wow-delay="0.7s">
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
        <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
            <small
                class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Customer
                Reviews</small>
            <h1 class="display-5 mb-5">What Our Customers says!</h1>
        </div>
        <div class="owl-carousel owl-theme testimonial-carousel testimonial-carousel-1 mb-4 wow bounceInUp"
            data-wow-delay="0.1s">
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
        <div class="owl-carousel testimonial-carousel testimonial-carousel-2 wow bounceInUp" data-wow-delay="0.3s">
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

@endsection