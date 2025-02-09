<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Semnas Inonus</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com') }}" rel="preconnect">
  <link href="https://fonts.gstatic.com') }}" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Marcellus:wght@400&display=swap') }}" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: AgriCulture
  * Template URL: https://bootstrapmade.com/agriculture-bootstrap-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center position-relative">
    {{-- Header --}}
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!--<img src="{{ asset('assets/img/logo.png') }}" alt="AgriCulture">-->
        <h1 class="sitename">Semnas Inonus</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ url('/') }}" class="active">Home</a></li>
          <li><a href="{{ url('/events') }}">Events</a></li>
          <li><a href="{{ url('/cart-event') }}">My Order <span class="position-absolute top-20 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $headerData['event'] }}
                <span class="visually-hidden">unread messages</span>
              </span></a></li>
          @if(Auth::check())
          <li class="dropdown">
            <a href="#">
              <i class="bi bi-person-circle px-3" style="font-size: 24px; transform: none !important;"></i> <!-- Profile icon -->
              <span>
                <!-- Display user's name here -->
                {{ Auth::user()->name }}
              </span>
              <i class="bi bi-chevron-down toggle-dropdown"></i>
            </a>
            <ul>
              <li><a href="{{ url('/riwayat-pembayaran') }}">Riwayat Pembayaran</a></li>
              <li><a href="{{ url('/data-events') }}">Data Event</a></li>
              <li><!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                                  this.closest('form').submit();">
                    {{ __('Log Out') }}
                  </x-dropdown-link>
                </form>
              </li>
            </ul>
          </li>
          @else
          <li><a href="{{ route('login') }}">Login</a></li>
          @endif
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  {{-- Content --}}
  @yield('content')

  <footer id="footer" class="footer dark-background">
    {{-- Footer --}}
    <!--<div class="footer-top">-->
    <!--  <div class="container">-->
    <!--    <div class="row gy-4">-->
    <!--      <div class="col-lg-4 col-md-6 footer-about">-->
    <!--        <a href="{{ url('/') }}" class="logo d-flex align-items-center">-->
    <!--          <span class="sitename">AgriCulture</span>-->
    <!--        </a>-->
    <!--        <div class="footer-contact pt-3">-->
    <!--          <p>A108 Adam Street</p>-->
    <!--          <p>New York, NY 535022</p>-->
    <!--          <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>-->
    <!--          <p><strong>Email:</strong> <span>info@example.com</span></p>-->
    <!--        </div>-->
    <!--      </div>-->

    <!--      <div class="col-lg-2 col-md-3 footer-links">-->
    <!--        <h4>Useful Links</h4>-->
    <!--        <ul>-->
    <!--          <li><a href="#">Home</a></li>-->
    <!--          <li><a href="#">About us</a></li>-->
    <!--          <li><a href="#">Services</a></li>-->
    <!--          <li><a href="#">Terms of service</a></li>-->
    <!--          <li><a href="#">Privacy policy</a></li>-->
    <!--        </ul>-->
    <!--      </div>-->

    <!--      <div class="col-lg-2 col-md-3 footer-links">-->
    <!--        <h4>Our Services</h4>-->
    <!--        <ul>-->
    <!--          <li><a href="#">Web Design</a></li>-->
    <!--          <li><a href="#">Web Development</a></li>-->
    <!--          <li><a href="#">Product Management</a></li>-->
    <!--          <li><a href="#">Marketing</a></li>-->
    <!--          <li><a href="#">Graphic Design</a></li>-->
    <!--        </ul>-->
    <!--      </div>-->

    <!--      <div class="col-lg-2 col-md-3 footer-links">-->
    <!--        <h4>Hic solutasetp</h4>-->
    <!--        <ul>-->
    <!--          <li><a href="#">Molestiae accusamus iure</a></li>-->
    <!--          <li><a href="#">Excepturi dignissimos</a></li>-->
    <!--          <li><a href="#">Suscipit distinctio</a></li>-->
    <!--          <li><a href="#">Dilecta</a></li>-->
    <!--          <li><a href="#">Sit quas consectetur</a></li>-->
    <!--        </ul>-->
    <!--      </div>-->

    <!--      <div class="col-lg-2 col-md-3 footer-links">-->
    <!--        <h4>Nobis illum</h4>-->
    <!--        <ul>-->
    <!--          <li><a href="#">Ipsam</a></li>-->
    <!--          <li><a href="#">Laudantium dolorum</a></li>-->
    <!--          <li><a href="#">Dinera</a></li>-->
    <!--          <li><a href="#">Trodelas</a></li>-->
    <!--          <li><a href="#">Flexo</a></li>-->
    <!--        </ul>-->
    <!--      </div>-->

    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->

    <div class="copyright text-center">
      <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">

        <div class="d-flex flex-column align-items-center align-items-lg-start">
          <div>
            © Copyright <strong><span>Semnas Inonus</span></strong>. All Rights Reserved
          </div>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
            2025
            <!--Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
          </div>
        </div>

        <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
          <a href=""><i class="bi bi-twitter-x"></i></a>
          <a href=""><i class="bi bi-facebook"></i></a>
          <a href=""><i class="bi bi-instagram"></i></a>
          <a href=""><i class="bi bi-linkedin"></i></a>
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
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @if(session('success'))
  <script>
    var successMessage = <?php echo json_encode(session('success')); ?>;
    Swal.fire({
      icon: 'success',
      title: 'Success',
      text: successMessage
    });
  </script>
  @endif

  @if(session('error'))
  <script>
    var errorMessage = <?php echo json_encode(session('error')); ?>;
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: errorMessage
    });
  </script>
  @endif

</body>

</html>