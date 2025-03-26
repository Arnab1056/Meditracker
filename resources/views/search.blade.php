<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>MediTracker</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: OnePage
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">MediTracker</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home<br></a></li>
          <li><a href="{{ route('cart.show') }}">Cart</a></li>

        </ul>
                  
              
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{ route('register') }}">Sign-up</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section d-flex align-items-center justify-content-center">
      <img src="{{ asset('assets/img/hero-bg-abstract.jpg') }}" alt="" data-aos="fade-in" class="position-absolute w-100 h-100">
      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-out">
          <dv class="col-xl-7 col-lg-9 text-center">
<div class="search-container" id="searchContainer">
    <h1>Search Medicines</h1>
    <form action="{{ route('search') }}" method="GET" onsubmit="moveSearchBar()" class="d-flex mb-4">
        <input type="text" name="query" id="searchInput" class="form-control me-2" placeholder="Search for medicines...">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <div id="results" class="row">
        @if(isset($results))
            @foreach($results as $result)
                @if($result->status !== 'pending')
                <div class="col-md-4 mb-4">
                    <div class="card h-100 w-100">
                        <div class="card-body">
                            <h2 class="card-title "><strong>{{ $result->medicine_name }}</strong></h2>
                            <h6 class="card-subtitle mb-2 md-5 text-muted">{{ $result->pharmacy_name }}</h6>
                            <p class="card-text">
                            <h6> <strong>Location:</strong></h6>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($result->location) }}" target="_blank">
                                   <a href="{{ $result->location }}">Click Here</a>
                                </a><br>
                                <strong>Available:</strong> {{ $result->available }}<br>
                                <strong>Quantity:</strong> {{ $result->quantity }}<br>
                                <h4><strong>Price:</strong> {{ $result->price }}</h4>
                            </p>
                            
                            <form action="{{ route('cart.add', ['id' => $result->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        @else
            <p class="text-muted">No results found.</p>
        @endif
    </div>
</div>
<script>
    function moveSearchBar() {
        document.getElementById('searchContainer').classList.add('top');
    }
</script>

        </div>
      </div>
    </section>
  </main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">MediTracker</span>
          </a>
          <p></p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Availability Of Medicines</a></li>
            <li><a href="#">Order</a></li>
            <li><a href="#">Searching</a></li>
            <li><a href="#">Delivery</a></li>
            <li><a href="#">Find Pharmacy</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>Premier University</p>
          <p>Chittagong</p>
          <p>Bangladesh</p>
          <p class="mt-4"><strong>Phone:</strong> <span>01812121212</span></p>
          <p><strong>Email:</strong> <span>info@example.com</span></p>
        </div>

      </div>
    </div>


  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>