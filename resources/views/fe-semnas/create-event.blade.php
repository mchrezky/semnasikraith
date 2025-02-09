@extends('fe-layouts.master')
@section('content')
<main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('assets/img/page-title-bg.webp') }}');">
        <div class="container position-relative">
            <h1>Create Events</h1>
            <p>
                Home
                /
                Events / Create Event</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/events') }}">Events</a></li>
                    <li class="current">Create Event</li>
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

            <form id="insert-form" action="{{ url('create-event-submit') }}" method="post" role="form" enctype="multipart/form-data">
                @csrf

                <div class="form-group mt-3 col-12">
                    <div class="border p-3 bg-light">
                        <label for="title">Judul Artikel <span class="text-danger">*</span></label>
                        <input id="title" type="text" name="title" required class="form-control" placeholder="Title">
                        <input id="event_list" type="hidden" name="event_list" value="{{ $data['event']->id }}" required class="form-control" placeholder="event_list">
                        <input id="seminar_name" type="hidden" name="seminar_name" value="{{ $data['event']->nama }}" required class="form-control" placeholder="seminar_name">
                    </div>
                </div>

                <div class="form-group mt-3 col-12">
                    <div class="border p-3 bg-light">
                        <label for="title">Jurnal Luaran Yang Dituju
                            <span class="text-danger">*</span></label><select id="category" name="category" class="form-control" required>
                            <option value="" disabled selected>Select Category</option>
                            @foreach ($data['categories'] as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group mt-3 col-12">
                        <div class="border p-3 bg-light">
                            <div class="row">
                                <div class="form-group mt-3 col-sm-12 col-md-6">
                                    <label for="writer1">Nama Penulis 1 (tanpa gelar-TIDAK BOLEH SALAH untuk SERTIFIKAT) <span class="text-danger">*</span></label>
                                    <input id="writer1" type="text" name="writer1" required class="form-control" placeholder="Nama Penulis 1 (Presenter)">
                                </div>
                                <div class="form-group mt-3 col-sm-12 col-md-6">
                                    <label for="email1">Email Penulis 1 <span class="text-danger">*</span></label>
                                    <input id="email1" type="email" name="email1" required class="form-control" placeholder="Email Penulis 1 (Presenter)">
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
                                    <label for="writer2">Nama Penulis 2 (tanpa gelar-TIDAK BOLEH SALAH untuk SERTIFIKAT) <span class="text-danger"></span></label>
                                    <input id="writer2" type="text" name="writer2" required class="form-control" placeholder="Nama Penulis 2">
                                </div>
                                <div class="form-group mt-3 col-sm-12 col-md-6">
                                    <label for="email2">Email Penulis 2 <span class="text-danger"></span></label>
                                    <input id="email2" type="email" name="email2" required class="form-control" placeholder="Email Penulis 2">
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
                                    <label for="writer3">Nama Penulis 3 (tanpa gelar-TIDAK BOLEH SALAH untuk SERTIFIKAT)</label>
                                    <input id="writer3" type="text" name="writer3" class="form-control" placeholder="Nama Penulis 3">
                                </div>
                                <div class="form-group mt-3 col-sm-12 col-md-6">
                                    <label for="email3">Email Penulis 3</label>
                                    <input id="email3" type="email" name="email3" class="form-control" placeholder="Email Penulis 3">
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
                                    <label for="writer4">Nama Penulis 4 (tanpa gelar-TIDAK BOLEH SALAH untuk SERTIFIKAT)</label>
                                    <input id="writer4" type="text" name="writer4" class="form-control" placeholder="Nama Penulis 4">
                                </div>
                                <div class="form-group mt-3 col-sm-12 col-md-6">
                                    <label for="email4">Email Penulis 4</label>
                                    <input id="email4" type="email" name="email4" class="form-control" placeholder="Email Penulis 4">
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
                                    <label for="writer5">Nama Penulis 5 (tanpa gelar-TIDAK BOLEH SALAH untuk SERTIFIKAT)</label>
                                    <input id="writer5" type="text" name="writer5" class="form-control" placeholder="Nama Penulis 5">
                                </div>
                                <div class="form-group mt-3 col-sm-12 col-md-6">
                                    <label for="email5">Email Penulis 5</label>
                                    <input id="email5" type="email" name="email5" class="form-control" placeholder="Email Penulis 5">
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
                                    <label for="writer6">Nama Penulis 6 (tanpa gelar-TIDAK BOLEH SALAH untuk SERTIFIKAT)</label>
                                    <input id="writer6" type="text" name="writer6" class="form-control" placeholder="Nama Penulis 6">
                                </div>
                                <div class="form-group mt-3 col-sm-12 col-md-6">
                                    <label for="email6">Email Penulis 6</label>
                                    <input id="email6" type="email" name="email6" class="form-control" placeholder="Email Penulis 6">
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
                                    <label for="writer7">Nama Penulis 7 (tanpa gelar-TIDAK BOLEH SALAH untuk SERTIFIKAT)</label>
                                    <input id="writer7" type="text" name="writer7" class="form-control" placeholder="Nama Penulis 7">
                                </div>
                                <div class="form-group mt-3 col-sm-12 col-md-6">
                                    <label for="email7">Email Penulis 7</label>
                                    <input id="email7" type="email" name="email7" class="form-control" placeholder="Email Penulis 7">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3 col-12">
                    <div class="row">
                        <div class="form-group mt-3 col-12">
                            <div class="border p-3 bg-light">
                                <div class="row">
                                    <!-- Turnitin Result (col 6) -->
                                    <div class="form-group mt-3 col-sm-12 col-md-6">
                                        <label for="hasil_cek_turnitin">Hasil cek Turnitin (maks 20%) <span class="text-danger">*</span></label>
                                        <input id="hasil_cek_turnitin" type="number" name="hasil_cek_turnitin" class="form-control" placeholder="Masukkan Hasil Cek Turnitin" max="20" required>
                                    </div>

                                    <!-- Turnitin File (col 6) -->
                                    <div class="form-group mt-3 col-sm-12 col-md-6">
                                        <label for="file_hasil_cek_turnitin">File Hasil Cek Turnitin (PDF Maksimal 10MB) <span class="text-danger">*</span></label>
                                        <input id="file_hasil_cek_turnitin" type="file" name="file_hasil_cek_turnitin" class="form-control" accept="application/pdf" required>
                                        <small class="text-muted">Maksimal ukuran file: 10MB, hanya PDF</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3 col-12">
                    <div class="row">
                        <div class="form-group mt-3 col-12">
                            <div class="border p-3 bg-light">
                                <div class="row">
                                    <!-- Turnitin Result (col 6) -->
                                    <!--<div class="form-group mt-3 col-sm-12 col-md-6">-->
                                    <!--    <label for="link_url_ojs">Link URL bukti sudah submit ke OJS terkait <span class="text-danger">*</span></label>-->
                                    <!--    <input id="link_url_ojs" type="text" name="link_url_ojs" class="form-control" placeholder="Masukkan Link URL OJS" required>-->
                                    <!--</div>-->

                                    <!-- Turnitin File (col 6) -->
                                    <div class="form-group mt-3 col-sm-12 col-md-12">
                                        <label for="file_ojs">File OJS (PDF Maksimal 10MB) <span class="text-danger">*</span></label>
                                        <input id="file_ojs" type="file" name="file_ojs" class="form-control" accept="application/pdf" required>
                                        <small class="text-muted">Maksimal ukuran file: 10MB, hanya PDF</small>
                                    </div>
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