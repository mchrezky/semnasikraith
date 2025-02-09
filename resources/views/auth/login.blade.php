@extends('fe-layouts.master')
@section('content')
<main class="main">

    

    <!-- About 3 Section -->
    <section id="about-3" class="about-3 section">
        <div class="container">
            <div class="row gy-4 justify-content-between align-items-center">
                
                <div class="col-lg-5 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact section">
                        
            <h1>Login</h1>
                        <form id="login-form" action="{{ route('login') }}" method="post" role="form">
                            @csrf
                            <div class="form-group mt-3">
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group mt-3">
                                <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control" placeholder="Password">
                            </div>

                            <!-- reCAPTCHA Widget -->
                            <div class="form-group mt-3">
                                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>

                            </div>

                            <div class="flex items-center mt-4 d-flex justify-content-between">
                                <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('register') }}">
                                    {{ __('Belum punya akun?') }}
                                </a>

                                <button id="login-btn" type="submit" class="btn btn-success ms-3">
                                    <span id="btn-text">Log in</span>
                                    <div id="spinner" class="spinner-border spinner-border-sm d-none" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2 position-relative" data-aos="zoom-out">
                    <img src="assets/img/img_sq_1.jpg" alt="Image" class="img-fluid">
                    <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn">
                        <span class="play"><i class="bi bi-play-fill"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </section><!-- /About 3 Section -->
</main>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById("login-form").addEventListener("submit", function(event) {
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

@if ($errors->has('password'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Email atau password salah.',
    });
</script>
@endif

@if ($errors->has('captcha'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'reCAPTCHA verification failed.',
    });
</script>
@endif

@endsection