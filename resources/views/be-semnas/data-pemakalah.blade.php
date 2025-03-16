@extends('be-layouts.master')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Pemakalah</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Data Pemakalah</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Data Pemakalah</h5>
                            <div class="filter">
                                <a href="#" class="btn btn-success" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-item">
                                        <form action="{{ url('/export-data-pemakalah') }}" method="GET" id="filterForm">
                                            <div class="form-group mt-3 col-12">
                                                <label for="date">Date
                                                </label>
                                                <input type="text" id="date-range" name="date" class="form-control" placeholder="Select Date Range">
                                            </div>
                                            <div class="form-group mt-3 col-12">
                                                <label for="semnas_id">Jenis Semnas
                                                </label>
                                                <select id="semnas_id" name="semnas_id" class="form-control" onchange="validateForm()">
                                                    <option value="" disabled selected>Select Semnas</option>
                                                    @foreach ($data['msSemnas'] as $msSemnas)
                                                    <option value="{{ $msSemnas->id }}">{{ $msSemnas->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- Tombol export hanya aktif jika form terisi -->
                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="submit" id="exportButton" class="btn btn-success">Export Data</button>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Seminar Name</th>
                                        <th>Title</th>
                                        <th>Penulis</th>
                                        </th>
                                        <th>Type</th>
                                        <th>Institusi</th>
                                        <th>Submit At</th>
                                        <th>Loa</th>
                                        <th>Status</th>
                                        <th>Status Review</th>
                                        <th width="150">Opsi / Review</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['dataPemakalah'] as $index => $dataPemakalah)
                                    <tr class="align-middle">
                                        <td style="text-align: center;">{{ $index + 1 }}</td>
                                        <td>{{ $dataPemakalah->seminar_name }}</td>
                                        <td>{{ $dataPemakalah->title }}</td>
                                        <td>{{ $dataPemakalah->writer1 }}</td>
                                        <td>{{ $dataPemakalah->user_tipe_user }}</td>
                                        <td>{{ $dataPemakalah->user_institusi_asal }}</td>
                                        <td>{{ $dataPemakalah->created_at }}</td>
                                        <td>{{ $dataPemakalah->file_loa ? 'OK' : '-' }}</td>
                                        <td>{{ $dataPemakalah->konfirmasi_bayar == 1 ? 'Pending' : ($dataPemakalah->konfirmasi_bayar == 2 ? 'Dibayar' : ($dataPemakalah->konfirmasi_bayar == 3 ? 'Berhasil Dikonfirmasi' : 'Status Tidak Dikenal')) }}</td>
                                        <td>
                                            @if ($dataPemakalah->review == 'Baru')
                                            <span class="badge rounded-pill bg-secondary">Makalah Baru</span>
                                            @elseif ($dataPemakalah->review == 'Telah Direview')
                                            <span class="badge rounded-pill bg-warning text-dark">Sudah Direview</span>
                                            @elseif ($dataPemakalah->review == 'Telah Direvisi')
                                            <span class="badge rounded-pill bg-primary">Sudah Direvisi</span>
                                            @elseif ($dataPemakalah->review == 'Selesai')
                                            <span class="badge rounded-pill bg-success">Sudah ACC</span>
                                            @else
                                            <span class="badge rounded-pill bg-dark">{{ $dataPemakalah->review }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(Auth::user()->role == 'Admin' )
                                            <a class="btn btn-warning me-2" href="{{ url('/edit-data-pemakalah/' . $dataPemakalah->id) }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            @else
                                            @if ($dataPemakalah->review == 'Telah Direvisi' || $dataPemakalah->review == 'Baru')
                                            <a class="btn btn-info" href="{{ url('/review-data-pemakalah/' . $dataPemakalah->id) }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ url('/review-pemakalah-submit') }}" method="POST" class="review-form d-inline">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $dataPemakalah->id }}" required readonly class="form-control">
                                                <button type="button" class="btn btn-success confirm-submit">
                                                    <i class="bi bi-check"></i>
                                                </button>
                                            </form>
                                            @endif
                                            @endif
                                            @if($dataPemakalah->konfirmasi_bayar == 3)
                                            <a class="btn btn-primary" target="_blank" href="{{ url('/download-sertifikat-data-pemakalah/' . $dataPemakalah->id) }}">
                                                <i class="bi bi-download"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.datatable').addEventListener('click', function(event) {
            if (event.target.classList.contains('confirm-submit')) {
                const form = event.target.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data akan dikirim untuk selesai direview.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Kirim!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Flatpickr dengan mode range
        flatpickr("#date-range", {
            mode: "range",
            dateFormat: "Y-m-d",
        });
    });
</script>