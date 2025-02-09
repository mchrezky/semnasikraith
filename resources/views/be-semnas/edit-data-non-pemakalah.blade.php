@extends('be-layouts.master')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Data Non Pemakalah</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/data-non-pemakalah') }}">Data Non Pemakalah</a></li>
                <li class="breadcrumb-item">Edit Data Non Pemakalah</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Data Non Pemakalah</h5>
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

                        <form id="insert-form" action="{{ url('edit-non-pemakalah-submit') }}" method="post" role="form" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mt-3 col-12">
                                <div class="border p-3 bg-light">
                                    <label for="title">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input id="nama_lengkap" type="text" name="nama_lengkap" value="{{ $data['event']->nama_lengkap }}" required class="form-control" placeholder="Nama Lengkap">
                                    <input id="id" type="hidden" name="id" value="{{ $data['event']->id }}" required class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mt-3 col-12">
                                    <div class="border p-3 bg-light">
                                        <div class="row">
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="bidang_ilmu">Bidang Ilmu <span class="text-danger">*</span></label>
                                                <input id="bidang_ilmu" type="text" name="bidang_ilmu" value="{{ $data['event']->bidang_ilmu }}" required class="form-control" placeholder="Bidang Ilmu">
                                            </div>
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="alamat_institusi">Alamat Institusi <span class="text-danger">*</span></label>
                                                <input id="alamat_institusi" type="text" name="alamat_institusi" value="{{ $data['event']->alamat_institusi }}" required class="form-control" placeholder="Alamat Institusi">
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
                                                <input id="institusi_asal" type="text" name="institusi_asal" value="{{ $data['event']->institusi_asal }}" required class="form-control" placeholder="Institusi Asal">
                                            </div>
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="kota">Kota <span class="text-danger">*</span></label>
                                                <input id="kota" type="text" name="kota" value="{{ $data['event']->kota }}" required class="form-control" placeholder="Kota">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center mt-4 d-flex justify-content-between">
                                <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ url('/data-non-pemakalah') }}">
                                    Kembali
                                </a>

                                <button id="login-btn" type="submit" class="btn btn-primary ms-3">
                                    <span id="btn-text">Edit Data</span>
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