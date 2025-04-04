@extends('layouts.app')
@section('title', 'Testimonial')

@section('content')

  <!-- Hero Start -->
  <div class="container-fluid bg-light py-6 my-6 mt-0" style="
    background: url('img/bg-cover.jpg');
    color: white;">
    <div class="container text-center animated bounceInDown">
    <h1 class="display-1 mb-4" style="color: white">Reviews</h1>
    <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
      <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
      <li class="breadcrumb-item text-light" aria-current="page">Reviews</li>
    </ol>
    </div>
  </div>
  <!-- Hero End -->

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
    <div class="owl-carousel testimonial-carousel testimonial-carousel-2">
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