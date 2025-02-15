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
                        <h5 class="card-title">Data Pemakalah</h5>
                        <div class="table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Seminar Name</th>
                                        <th>Title</th>
                                        <th>Created By</th>
                                        <th>User Type</th>
                                        <th>Institusi Asal</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Status Review</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['dataPemakalah'] as $index => $dataPemakalah)
                                    <tr class="align-middle">
                                        <td style="text-align: center;">{{ $index + 1 }}</td>
                                        <td>{{ $dataPemakalah->seminar_name }}</td>
                                        <td>{{ $dataPemakalah->title }}</td>
                                        <td>{{ $dataPemakalah->user_name }}</td>
                                        <td>{{ $dataPemakalah->user_tipe_user }}</td>
                                        <td>{{ $dataPemakalah->user_institusi_asal }}</td>
                                        <td>{{ $dataPemakalah->created_at }}</td>
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
                                            @if ($dataPemakalah->review == 'Telah Direvisi' || $dataPemakalah->review == 'Baru')
                                            <a class="btn btn-warning me-2" href="{{ url('/edit-data-pemakalah/' . $dataPemakalah->id) }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a class="btn btn-info" href="{{ url('/review-data-pemakalah/' . $dataPemakalah->id) }}">
                                                <i class="fas fa-search"></i> Review
                                            </a>
                                            <form id="review-form" action="{{ url('/review-pemakalah-submit') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input id="id" type="hidden" name="id" value="{{ $dataPemakalah->id }}" required class="form-control" readonly>
                                                <button type="button" class="btn btn-success" id="confirm-submit">
                                                    <i class="fas fa-search"></i> Selesai
                                                </button>
                                            </form>
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
        document.getElementById('confirm-submit').addEventListener('click', function(event) {
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
                    document.getElementById('review-form').submit();
                }
            });
        });
    });
</script>