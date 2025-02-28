@extends('layouts.app')
@section('title', 'singlepage')
@section('content')

    <div class="container mt-5">
        <div class="row">
            <!-- Left side: Product images -->
            <div class="col-md-5">
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
            <div class="col-md-6" style="position: relative;left: 140px;">
                <h2>Bandar Laddu / Tokkudu Laddu</h2>
                <p class="text-warning"><strong>⭐⭐⭐⭐⭐ 3 reviews</strong></p>
                <h4>Rs. 160.00</h4>
                <p><small>Shipping calculated at checkout.</small></p>

                <div class="mb-3">
                    <label for="weight" class="form-label"><strong>Weight</strong></label>
                    <select class="form-select" id="weight">
                        <option>250 gms</option>
                        <option>500 gms</option>
                        <option>1 kg</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label"><strong>Quantity</strong></label>
                    <input type="number" class="form-control" id="quantity" value="1" min="1">
                </div>

                <button class="btn btn-dark btn-lg w-100 mb-2">Add to Cart</button>
                <button class="btn btn-outline-dark btn-lg w-100">Buy Now</button>

                <hr>

                <h4>Product Information</h4>
                <p>Bandar Laddu is the native and most popular sweet belonging to Machilipatnam town based in Andhra
                    Pradesh. It is made of besan flour, jaggery or sugar, ghee, and cardamom powder.</p>

                <h5>Ingredients</h5>
                <ul>
                    <li>Besan flour</li>
                    <li>Sugar</li>
                    <li>Ghee</li>
                    <li>Cardamom powder</li>
                </ul>

                <h5>Nutritional Facts</h5>
                <table class="table">
                    <tr>
                        <td>Carbohydrates</td>
                        <td>22 g</td>
                    </tr>
                    <tr>
                        <td>Protein</td>
                        <td>3 g</td>
                    </tr>
                    <tr>
                        <td>Fat</td>
                        <td>8 mg</td>
                    </tr>
                    <tr>
                        <td>Fiber</td>
                        <td>1 mg</td>
                    </tr>
                    <tr>
                        <td>Calcium</td>
                        <td>10 mg</td>
                    </tr>
                    <tr>
                        <td>Iron</td>
                        <td>0.8 mg</td>
                    </tr>
                    <tr>
                        <td>Potassium</td>
                        <td>114 mg</td>
                    </tr>
                </table>
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

@endsection