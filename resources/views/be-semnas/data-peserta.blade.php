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
                                            @if($dataPeserta->role == "Guest")
                                            <form action="{{ url('/data-peserta-to-reviewer-submit') }}" method="POST" class="delete-form d-inline">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $dataPeserta->id }}" required readonly class="form-control">
                                                <button type="button" class="btn btn-warning to-reviewer-submit" data-id="{{ $dataPeserta->id }}">
                                                    Ubah ke Reviewer
                                                </button>
                                            </form>
                                            @elseif($dataPeserta->role == "Reviewer")
                                            <form action="{{ url('/data-peserta-delete-reviewer-submit') }}" method="POST" class="delete-form d-inline">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $dataPeserta->id }}" required readonly class="form-control">
                                                <button type="button" class="btn btn-danger delete-reviewer-submit" data-id="{{ $dataPeserta->id }}">
                                                    Hapus menjadi Reviewer
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
        document.querySelectorAll('.to-reviewer-submit').forEach(button => {
            button.addEventListener('click', function(event) {
                const form = this.closest('form');
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
            });
        });

        document.querySelectorAll('.delete-reviewer-submit').forEach(button => {
            button.addEventListener('click', function(event) {
                const form = this.closest('form');
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
            });
        });
    });
</script>