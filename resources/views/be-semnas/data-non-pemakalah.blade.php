@extends('be-layouts.master')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Non Pemakalah</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Data Non Pemakalah</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Non Pemakalah</h5>
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
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['dataNonPemakalah'] as $index => $dataNonPemakalah)
                                    <tr class="align-middle">
                                        <td style="text-align: center;">{{ $index + 1 }}</td>
                                        <td>{{ $dataNonPemakalah->seminar_name }}</td>
                                        <td>{{ $dataNonPemakalah->title }}</td>
                                        <td>{{ $dataNonPemakalah->user_name }}</td>
                                        <td>{{ $dataNonPemakalah->user_tipe_user }}</td>
                                        <td>{{ $dataNonPemakalah->user_institusi_asal }}</td>
                                        <td>{{ $dataNonPemakalah->created_at }}</td>
                                        <td>{{ $dataNonPemakalah->konfirmasi_bayar == 1 ? 'Pending' : ($dataNonPemakalah->konfirmasi_bayar == 2 ? 'Dibayar' : ($dataNonPemakalah->konfirmasi_bayar == 3 ? 'Berhasil Dikonfirmasi' : 'Status Tidak Dikenal')) }}</td>
                                        <td>
                                            <a type="button" class="btn btn-warning" href="{{ url('/edit-data-non-pemakalah/' . $dataNonPemakalah->id) }}">Edit</a>
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