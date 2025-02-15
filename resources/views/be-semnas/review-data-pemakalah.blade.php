@extends('be-layouts.master')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Review Data Pemakalah</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/data-pemakalah') }}">Data Pemakalah</a></li>
                <li class="breadcrumb-item">Review Data Pemakalah</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Review Data Pemakalah</h5>
                        <div class="d-flex flex-column flex-md-row align-items-center p-4">
                            <!-- Gambar di atas pada layar kecil dan di kiri pada layar besar -->
                            <div class="center mb-3 mb-md-0 me-md-4">
                                <img src="{{ asset('assets/img/event/' . $data['event']->event_list_foto) }}" alt="Image" class="img-fluid img-overlap" style="height: 300px;" data-aos="zoom-out">
                            </div>

                            <!-- Informasi di bawah gambar pada layar kecil dan di sebelah kanan pada layar besar -->
                            <div class="content">
                                <h4 class="mb-2">{{ $data['event']->event_list_name }}</h4>
                                <p class="text-muted mb-4">{{ $data['event']->event_list_ket }}</p>

                                <div class="meta d-flex align-items-center mb-3 p-0">
                                    <!-- Harga -->
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-cash-coin"></i> <span class="ps-2">Rp {{ number_format($data['event']->event_list_harga, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form id="insert-form" action="{{ url('review-pemakalah-submit') }}" method="post" role="form" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mt-3 col-12">
                                <div class="border p-3 bg-light">
                                    <label for="title">Judul Artikel <span class="text-danger">*</span></label>
                                    <input id="title" type="text" name="title" value="{{ $data['event']->title }}" required class="form-control" readonly placeholder="Title">
                                    <input id="id" type="hidden" name="id" value="{{ $data['event']->id }}" required class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group mt-3 col-12">
                                <div class="border p-3 bg-light">
                                    <label for="category">Jurnal Luaran Yang Dituju
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select id="category" name="category" class="form-control" disabled required>
                                        <option value="" disabled>Select Category</option>
                                        @foreach ($data['categories'] as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($category->id == $data['event']->category) selected @endif>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="category" value="{{ $data['event']->category }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mt-3 col-12">
                                    <div class="border p-3 bg-light">
                                        <div class="row">
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="writer1">Nama Penulis 1 (tanpa gelar-TIDAK BOLEH SALAH untuk SERTIFIKAT) <span class="text-danger">*</span></label>
                                                <input id="writer1" type="text" name="writer1" value="{{ $data['event']->writer1 }}" required class="form-control" readonly placeholder="Nama Penulis 1 (Presenter)">
                                            </div>
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="email1">Email Penulis 1 <span class="text-danger">*</span></label>
                                                <input id="email1" type="email" name="email1" value="{{ $data['event']->email1 }}" required class="form-control" readonly placeholder="Email Penulis 1 (Presenter)">
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
                                                <input id="writer2" type="text" name="writer2" value="{{ $data['event']->writer2 }}" class="form-control" readonly placeholder="Nama Penulis 2">
                                            </div>
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="email2">Email Penulis 2 <span class="text-danger"></span></label>
                                                <input id="email2" type="email" name="email2" value="{{ $data['event']->email2 }}" class="form-control" readonly placeholder="Email Penulis 2">
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
                                                <input id="writer3" type="text" name="writer3" value="{{ $data['event']->writer3 }}" class="form-control" readonly placeholder="Nama Penulis 3">
                                            </div>
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="email3">Email Penulis 3</label>
                                                <input id="email3" type="email" name="email3" value="{{ $data['event']->email3 }}" class="form-control" readonly placeholder="Email Penulis 3">
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
                                                <input id="writer4" type="text" name="writer4" value="{{ $data['event']->writer4 }}" class="form-control" readonly placeholder="Nama Penulis 4">
                                            </div>
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="email4">Email Penulis 4</label>
                                                <input id="email4" type="email" name="email4" value="{{ $data['event']->email4 }}" class="form-control" readonly placeholder="Email Penulis 4">
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
                                                <input id="writer5" type="text" name="writer5" value="{{ $data['event']->writer5 }}" class="form-control" readonly placeholder="Nama Penulis 5">
                                            </div>
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="email5">Email Penulis 5</label>
                                                <input id="email5" type="email" name="email5" value="{{ $data['event']->email5 }}" class="form-control" readonly placeholder="Email Penulis 5">
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
                                                <input id="writer6" type="text" name="writer6" value="{{ $data['event']->writer6 }}" class="form-control" readonly placeholder="Nama Penulis 6">
                                            </div>
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="email6">Email Penulis 6</label>
                                                <input id="email6" type="email" name="email6" value="{{ $data['event']->email6 }}" class="form-control" readonly placeholder="Email Penulis 6">
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
                                                <input id="writer7" type="text" name="writer7" value="{{ $data['event']->writer7 }}" class="form-control" readonly placeholder="Nama Penulis 7">
                                            </div>
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="email7">Email Penulis 7</label>
                                                <input id="email7" type="email" name="email7" value="{{ $data['event']->email7 }}" class="form-control" readonly placeholder="Email Penulis 7">
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
                                                    <input id="hasil_cek_turnitin" type="number" name="hasil_cek_turnitin" value="{{ $data['event']->hasil_cek_turnitin }}" class="form-control" readonly placeholder="Masukkan Hasil Cek Turnitin" max="20" required>
                                                </div>

                                                <!-- Turnitin File (col 6) -->
                                                <div class="form-group mt-3 col-sm-12 col-md-6">
                                                    <label for="file_hasil_cek_turnitin">File Hasil Cek Turnitin (PDF Maksimal 10MB)
                                                        <span class="text-danger">*</span>
                                                    </label>

                                                    @if (!empty($data['event']->file_hasil_cek_turnitin))
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ asset('storage/file_turnitin/' . $data['event']->file_hasil_cek_turnitin) }}"
                                                            target="_blank"
                                                            class="btn btn-outline-primary fw-bold px-4 py-2 shadow-sm rounded-pill">
                                                            <i class="fas fa-file-pdf me-2"></i> Lihat File
                                                        </a>
                                                    </div>
                                                    @else
                                                    <p class="text-muted">Tidak ada file tersedia</p>
                                                    @endif
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
                                                <!--    <input id="link_url_ojs" type="text" name="link_url_ojs" class="form-control" readonly placeholder="Masukkan Link URL OJS" required>-->
                                                <!--</div>-->

                                                <!-- Turnitin File (col 6) -->
                                                <div class="form-group mt-3 col-sm-12 col-md-12">
                                                    <label for="file_ojs">File OJS (PDF Maksimal 10MB) <span class="text-danger">*</span></label>

                                                    @if (!empty($data['event']->file_ojs))
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ asset('storage/file_ojs/' . $data['event']->file_ojs) }}"
                                                            target="_blank"
                                                            class="btn btn-outline-primary fw-bold px-4 py-2 shadow-sm rounded-pill">
                                                            <i class="fas fa-file-pdf me-2"></i> Lihat File
                                                        </a>
                                                    </div>
                                                    @else
                                                    <p class="text-muted">Tidak ada file tersedia</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h5 class="card-title text-center mt-5">Review Data Pemakalah</h5>
                            <div class="row">
                                <div class="form-group mt-3 col-12">
                                    <div class="border p-3 bg-light">
                                        <div class="row">
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="abstrak">Review Abstrak <span class="text-danger">*</span></label>
                                                <textarea id="abstrak" type="text" name="abstrak" required class="form-control" placeholder="Review Abstrak"></textarea>
                                            </div>
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="metode_penelitian">Review Metode Penelitian <span class="text-danger">*</span></label>
                                                <textarea id="metode_penelitian" type="text" name="metode_penelitian" required class="form-control" placeholder="Review Metode Penelitian"></textarea>
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
                                                <label for="pembahasan">Review Pembahasan <span class="text-danger">*</span></label>
                                                <textarea id="pembahasan" type="text" name="pembahasan" required class="form-control" placeholder="Review Pembahasan"></textarea>
                                            </div>
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="kesimpulan">Review Kesimpulan <span class="text-danger">*</span></label>
                                                <textarea id="kesimpulan" type="text" name="kesimpulan" required class="form-control" placeholder="Review Kesimpulan"></textarea>
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
                                                <label for="plagriasi_turnitin">Review Plagriasi Turnitin <span class="text-danger">*</span></label>
                                                <textarea id="plagriasi_turnitin" type="text" name="plagriasi_turnitin" required class="form-control" placeholder="Review Plagriasi Turnitin"></textarea>
                                            </div>
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="ket_review">Keterangan Review <span class="text-danger">*</span></label>
                                                <textarea id="ket_review" type="text" name="ket_review" required class="form-control" placeholder="Keterangan Review"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center mt-4 d-flex justify-content-between">
                                <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ url('/data-pemakalah') }}">
                                    Kembali
                                </a>

                                <button id="login-btn" type="submit" class="btn btn-primary ms-3">
                                    <span id="btn-text">Review Data</span>
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
    </section>
</main><!-- End #main -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById("insert-form").addEventListener("submit", function(event) {
            let loginBtn = document.getElementById("login-btn");
            let spinner = document.getElementById("spinner");
            let btnText = document.getElementById("btn-text");


            loginBtn.disabled = true;
            spinner.classList.remove("d-none");
            btnText.textContent = "Loading...";
        });
    });
</script>
@endsection