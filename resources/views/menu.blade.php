@extends('layouts.app')
@section('title', 'Menu')

@section('content')
<!-- Hero Start -->
<div class="container-fluid py-6 my-6 mt-0" style="
        background: url('img/bg-cover.jpg') no-repeat center center/cover;
        color: white;height: 379px;">
  <div class="container text-center animated bounceInDown">
    <h1 class="display-1 mb-4" style="color: white">Menu</h1>
    <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
      <li class="breadcrumb-item">
        <a href="{{url('/')}}" style="color: white">Home</a>
      </li>
      <li class="breadcrumb-item text-light" aria-current="page">Menu</li>
    </ol>
  </div>
</div>
<!-- Hero End -->


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
          <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill" data-bs-toggle="pill" href="#tab-7">
            <span class="text-dark" style="width: 150px">veg</span>
          </a>
        </li>
        <li class="nav-item p-2">
          <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill" data-bs-toggle="pill" href="#tab-8">
            <span class="text-dark" style="width: 150px">Sweets</span>
          </a>
        </li>
        <li class="nav-item p-2">
          <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill" data-bs-toggle="pill" href="#tab-9">
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


@endsection