@extends('be-layouts.master')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Semnas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Data Semnas</li>
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
                            <h5 class="card-title">Data Semnas</h5>
                            <button type="button" class="btn btn-info add-btn" data-bs-toggle="modal" data-bs-target="#addModal">
                                Add Data
                            </button>
                        </div>
                        <div class="table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Foto</th>
                                        <th>Tema</th>
                                        <th>Tanggal</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['msSemnas'] as $index => $msSemnas)
                                    <tr class="align-middle" data-id="{{ $msSemnas->id }}" data-name="{{ $msSemnas->name }}" data-tema="{{ $msSemnas->tema }}" data-tanggal="{{ $msSemnas->tanggal }}">
                                        <td style="text-align: center;">{{ $index + 1 }}</td>
                                        <td>{{ $msSemnas->name }}</td>
                                        <td><img src="{{ asset('storage/file_ms_semnas/' . $msSemnas->foto) }}" alt="Bukti Pembayaran" class="img-thumbnail" style="max-width: 100px;"></td>
                                        <td>{{ $msSemnas->tema }}</td>
                                        <td>{{ $msSemnas->tanggal }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">
                                                Edit
                                            </button>
                                            <form action="{{ url('/delete-master-semnas-submit') }}" method="POST" class="delete-form d-inline">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $msSemnas->id }}" required readonly class="form-control">
                                                <button type="button" class="btn btn-danger delete-submit" data-id="{{ $msSemnas->id }}">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
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

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insert-form" action="{{ url('add-master-semnas-submit') }}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3 col-12">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input id="name" type="text" name="name" required class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="file_ms_semnas">Foto Semnas <span class="text-danger">*</span></label>
                            <input id="file_ms_semnas" type="file" name="file_ms_semnas" class="form-control"
                                accept="image/png, image/jpeg" required>
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="tema">Tema <span class="text-danger">*</span></label>
                            <input id="tema" type="text" name="tema" required class="form-control" placeholder="Tema">
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="tanggal">Tanggal <span class="text-danger">*</span></label>
                            <input id="tanggal" type="text" name="tanggal" required class="form-control" placeholder="Tanggal">
                        </div>

                        <div class="flex items-center mt-4 d-flex justify-content-end">
                            <button id="login-btn" type="submit" class="btn btn-success ms-3">
                                <span id="btn-text">Add Data</span>
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

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-form" action="{{ url('edit-master-semnas-submit') }}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3 col-12">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="hidden" name="id" id="modal-id">
                            <input id="name-modal" type="text" name="name" required class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="file_ms_semnas">Foto Semnas</label>
                            <input id="file_ms_semnas" type="file" name="file_ms_semnas" class="form-control"
                                accept="image/png, image/jpeg">
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="tema">Tema <span class="text-danger">*</span></label>
                            <input id="tema-modal" type="text" name="tema" required class="form-control" placeholder="Tema">
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="tanggal">Tanggal <span class="text-danger">*</span></label>
                            <input id="tanggal-modal" type="text" name="tanggal" required class="form-control" placeholder="Tanggal">
                        </div>

                        <div class="flex items-center mt-4 d-flex justify-content-end">
                            <button id="edit-btn" type="submit" class="btn btn-success ms-3">
                                <span id="btn-text-edit">Edit Data</span>
                                <div id="spinner-edit" class="spinner-border spinner-border-sm d-none" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const orderId = row.getAttribute('data-id');
                const name = row.getAttribute('data-name');
                const tema = row.getAttribute('data-tema');
                const tanggal = row.getAttribute('data-tanggal');

                document.getElementById('modal-id').value = orderId;
                document.getElementById('name-modal').value = name;
                document.getElementById('tema-modal').value = tema;
                document.getElementById('tanggal-modal').value = tanggal;
            });
        });

        document.getElementById("insert-form").addEventListener("submit", function(event) {
            let loginBtn = document.getElementById("login-btn");
            let spinner = document.getElementById("spinner");
            let btnText = document.getElementById("btn-text");

            loginBtn.disabled = true;
            spinner.classList.remove("d-none");
            btnText.textContent = "Loading...";
        });

        document.getElementById("edit-form").addEventListener("submit", function(event) {
            let loginBtn = document.getElementById("edit-btn");
            let spinner = document.getElementById("spinner-edit");
            let btnText = document.getElementById("btn-text-edit");

            loginBtn.disabled = true;
            spinner.classList.remove("d-none");
            btnText.textContent = "Loading...";
        });

        document.querySelectorAll('.delete-submit').forEach(button => {
            button.addEventListener('click', function(event) {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data banner akan dihapus.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
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