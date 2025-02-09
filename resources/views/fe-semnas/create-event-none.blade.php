@extends('fe-layouts.master')
@section('content')
<main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('assets/img/page-title-bg.webp') }}');">
        <div class="container position-relative">
            <h1>Create Events Non Pemakalah</h1>
            <p>
                Home
                /
                Events / Create Event Non Pemakalah</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/events') }}">Events</a></li>
                    <li class="current">Create Event Non Pemakalah</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Blog Posts 2 Section -->
    <section id="blog-posts-2" class="blog-posts-2 section">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-center p-4">
                <!-- Gambar di atas pada layar kecil dan di kiri pada layar besar -->
                <div class="center mb-3 mb-md-0 me-md-4">
                    <img src="{{ asset('assets/img/event/' . $data['event']->foto) }}" alt="Image" class="img-fluid img-overlap" style="height: 300px;" data-aos="zoom-out">
                </div>

                <!-- Informasi di bawah gambar pada layar kecil dan di sebelah kanan pada layar besar -->
                <div class="content">
                    <h4 class="mb-2">{{ $data['event']->nama }}</h4>
                    <p class="text-muted mb-4">{{ $data['event']->ket }}</p>

                    <div class="meta d-flex align-items-center mb-3 p-0">
                        <!-- Kategori -->
                        <div class="d-flex align-items-center me-3">
                            <i class="bi bi-tags"></i> <span class="ps-2">{{ $data['event']->type_name }}</span>
                        </div>

                        <!-- Harga -->
                        <div class="d-flex align-items-center">
                            <i class="bi bi-cash-coin"></i> <span class="ps-2">Rp {{ number_format($data['event']->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <form id="insert-form" action="{{ url('create-event-non-submit') }}" method="post" role="form" enctype="multipart/form-data">
                @csrf

                <div class="form-group mt-3 col-12">
                    <div class="border p-3 bg-light">
                        <label for="title">Nama Lengkap <span class="text-danger">*</span></label>
                        <input id="nama_lengkap" type="text" name="nama_lengkap" required class="form-control" placeholder="Nama Lengkap">
                        <input id="event_list" type="hidden" name="event_list" value="{{ $data['event']->id }}" required class="form-control" placeholder="event_list">
                        <input id="seminar_name" type="hidden" name="seminar_name" value="{{ $data['event']->nama }}" required class="form-control" placeholder="seminar_name">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group mt-3 col-12">
                        <div class="border p-3 bg-light">
                            <div class="row">
                                <div class="form-group mt-3 col-sm-12 col-md-6">
                                    <label for="bidang_ilmu">Bidang Ilmu <span class="text-danger">*</span></label>
                                    <input id="bidang_ilmu" type="text" name="bidang_ilmu" required class="form-control" placeholder="Bidang Ilmu">
                                </div>
                                <div class="form-group mt-3 col-sm-12 col-md-6">
                                    <label for="alamat_institusi">Alamat Institusi <span class="text-danger">*</span></label>
                                    <input id="alamat_institusi" type="text" name="alamat_institusi" required class="form-control" placeholder="Alamat Institusi">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group mt-3 col-12">
                        <div class="border p-3 bg-light">
                            <div class="row">
                                <div class="form-group mt-3 col-sm-12 col-md-6">
                                    <label for="institusi_asal">Institusi Asal <span class="text-danger">*</span></label>
                                    <input id="institusi_asal" type="text" name="institusi_asal" required class="form-control" placeholder="Institusi Asal">
                                </div>
                                <div class="form-group mt-3 col-sm-12 col-md-6">
                                    <label for="kota">Kota <span class="text-danger">*</span></label>
                                    <input id="kota" type="text" name="kota" required class="form-control" placeholder="Kota">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center mt-4 d-flex justify-content-between">
                    <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ url('/events') }}">
                        Kembali
                    </a>

                    <button id="login-btn" type="submit" class="btn btn-success ms-3">
                        <span id="btn-text">Daftar</span>
                        <div id="spinner" class="spinner-border spinner-border-sm d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </div>
            </form>


        </div>
    </section>
</main>

<script>
    document.getElementById("insert-form").addEventListener("submit", function(event) {
        let loginBtn = document.getElementById("login-btn");
        let spinner = document.getElementById("spinner");
        let btnText = document.getElementById("btn-text");


        loginBtn.disabled = true;
        spinner.classList.remove("d-none");
        btnText.textContent = "Loading...";
    });
</script>
@endsection