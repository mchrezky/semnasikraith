@extends('fe-layouts.master')
@section('content')
<main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.webp);">
        <div class="container position-relative">
            <h1>Register</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Register</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- About 3 Section -->
    <section id="about-3" class="about-3 section">
        <div class="container">
            <div class="row gy-4 justify-content-between align-items-center">
                <div class="col-lg-6 order-lg-2 position-relative" data-aos="zoom-out">
                    <img src="assets/img/img_sq_1.jpg" alt="Image" class="img-fluid">
                    <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn">
                        <span class="play"><i class="bi bi-play-fill"></i></span>
                    </a>
                </div>
                <div class="col-lg-5 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact section">
                        <form id="register-form" action="{{ route('register') }}" method="post" role="form">
                            @csrf
                            <div class="form-group mt-3">
                                <input id="name" type="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group mt-3">
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group mt-3">
                                <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group mt-3">
                                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="form-control" placeholder="Confirm Password">
                            </div>

                            <!-- reCAPTCHA Widget -->
                            <div class="form-group mt-3">
                                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                            </div>

                            <div class="flex items-center mt-4 d-flex justify-content-between">
                                <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('login') }}">
                                    {{ __('Sudah punya akun?') }}
                                </a>

                                <button id="login-btn" type="submit" class="btn btn-success ms-3">
                                    <span id="btn-text">Register</span>
                                    <div id="spinner" class="spinner-border spinner-border-sm d-none" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /About 3 Section -->
</main>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById("register-form").addEventListener("submit", function(event) {
        let recaptchaResponse = grecaptcha.getResponse();
        let loginBtn = document.getElementById("login-btn");
        let spinner = document.getElementById("spinner");
        let btnText = document.getElementById("btn-text");

        if (recaptchaResponse === "") {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please complete the CAPTCHA verification.',
            });
        } else {
            loginBtn.disabled = true;
            spinner.classList.remove("d-none");
            btnText.textContent = "Logging in...";
        }
    });
</script>

@if ($errors->any())
@php
$errorMessages = implode("\n", $errors->all());
@endphp
<script>
    let errorMessages = <?php echo json_encode($errorMessages); ?>;

    if (errorMessages) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: errorMessages,
        });
    }
</script>
@endif



@endsection