@extends('layouts.app')
@section('title', 'Teams')

@section('content')


<!-- Hero Start -->
<div class="container-fluid bg-light py-6 my-6 mt-0" style="
        background: url('img/bg-cover.jpg') no-repeat center center/cover;
        color: white;">
  <div class="container text-center animated bounceInDown">
    <h1 class="display-1 mb-4" style="color: white">Our Team</h1>
    <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
      <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
      <li class="breadcrumb-item text-light" aria-current="page">Our Team</li>
    </ol>
  </div>
</div>
<!-- Hero End -->


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
          <img class="img-fluid rounded-top" src="img/team-1.jpg" alt="" />
          <div class="team-content text-center py-3 bg-dark rounded-bottom">
            <h4 class="text-primary">Chef 1</h4>
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
          <img class="img-fluid rounded-top" src="img/team-2.jpg" alt="" />
          <div class="team-content text-center py-3 bg-dark rounded-bottom">
            <h4 class="text-primary">Chef 2</h4>
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
          <img class="img-fluid rounded-top" src="img/team-3.jpg" alt="" />
          <div class="team-content text-center py-3 bg-dark rounded-bottom">
            <h4 class="text-primary">Chef 3</h4>
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
          <img class="img-fluid rounded-top" src="img/team-4.jpg" alt="" />
          <div class="team-content text-center py-3 bg-dark rounded-bottom">
            <h4 class="text-primary">Chef 4</h4>
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

@endsection