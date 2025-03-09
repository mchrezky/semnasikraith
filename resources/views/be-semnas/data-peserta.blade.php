@extends('be-layouts.master')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Peserta</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Data Peserta</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Peserta</h5>
                        <div class="table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>No Telp</th>
                                        <th>User Type</th>
                                        <th>Role</th>
                                        <th>Institusi Asal</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['dataPeserta'] as $index => $dataPeserta)
                                    <tr class="align-middle">
                                        <td style="text-align: center;">{{ $index + 1 }}</td>
                                        <td>{{ $dataPeserta->name }}</td>
                                        <td>{{ $dataPeserta->email  }}</td>
                                        <td>{{ $dataPeserta->no_telp }}</td>
                                        <td>{{ $dataPeserta->tipe_user }}</td>
                                        <td>{{ $dataPeserta->role }}</td>
                                        <td>{{ $dataPeserta->institusi_asal }}</td>
                                        <td>
                                            <div class="d-flex justify-content-between gap-2">
                                                <form action="{{ url('/data-peserta-to-reset-submit') }}" method="POST" class="delete-form d-inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $dataPeserta->id }}" required readonly class="form-control">
                                                    <button type="button" class="btn btn-primary p-1" data-id="{{ $dataPeserta->id }}">
                                                        <i class="bi bi-key-fill to-reset-submit fs-4"></i>
                                                    </button>
                                                </form>
                                                @if($dataPeserta->role == "Guest")
                                                <form action="{{ url('/data-peserta-to-reviewer-submit') }}" method="POST" class="delete-form d-inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $dataPeserta->id }}" required readonly class="form-control">
                                                    <button type="button" class="btn btn-warning p-1" data-id="{{ $dataPeserta->id }}">
                                                        <i class="bi bi-people to-reviewer-submit fs-4"></i>
                                                    </button>
                                                </form>
                                                @elseif($dataPeserta->role == "Reviewer")
                                                <form action="{{ url('/data-peserta-delete-reviewer-submit') }}" method="POST" class="delete-form d-inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $dataPeserta->id }}" required readonly class="form-control">
                                                    <button type="button" class="btn btn-danger p-1" data-id="{{ $dataPeserta->id }}">
                                                        <i class="bi-person-workspace delete-reviewer-submit fs-4"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
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
            if (event.target.classList.contains('to-reviewer-submit')) {
                const form = event.target.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Peserta akan menjadi reviewer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }

            if (event.target.classList.contains('delete-reviewer-submit')) {
                const form = event.target.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Peserta akan dihapus dari reviewer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }

            if (event.target.classList.contains('to-reset-submit')) {
                const form = event.target.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Akun Peserta akan di Reset Password.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!',
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