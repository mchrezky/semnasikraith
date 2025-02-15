@extends('be-layouts.master')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Banner</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Data Banner</li>
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
                            <h5 class="card-title">Data Banner</h5>
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
                                        <th>Title</th>
                                        <th>Foto</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['banner'] as $index => $banner)
                                    <tr class="align-middle" data-id="{{ $banner->id }}" data-title="{{ $banner->title }}">
                                        <td style="text-align: center;">{{ $index + 1 }}</td>
                                        <td>{{ $banner->title }}</td>
                                        <td><img src="{{ asset('storage/file_banner/' . $banner->foto) }}" alt="Bukti Pembayaran" class="img-thumbnail" style="max-width: 100px;"></td>
                                        <td>
                                            <button type="button" class="btn btn-warning edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">
                                                Edit
                                            </button>
                                            <form action="{{ url('/delete-master-banner-submit') }}" method="POST" class="delete-form d-inline">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $banner->id }}" required readonly class="form-control">
                                                <button type="button" class="btn btn-danger delete-submit" data-id="{{ $banner->id }}">
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
                    <form id="insert-form" action="{{ url('add-master-banner-submit') }}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3 col-12">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input id="title" type="text" name="title" required class="form-control" placeholder="Title">
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="file_banner">Foto Banner <span class="text-danger">*</span></label>
                            <input id="file_banner" type="file" name="file_banner" class="form-control"
                                accept="image/png, image/jpeg" required>
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
                    <form id="edit-form" action="{{ url('edit-master-banner-submit') }}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3 col-12">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input type="hidden" name="id" id="modal-id">
                            <input id="title-modal" type="text" name="title" required class="form-control" placeholder="Title">
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="file_banner">Foto Banner</label>
                            <input id="file_banner" type="file" name="file_banner" class="form-control"
                                accept="image/png, image/jpeg">
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
                const title = row.getAttribute('data-title');

                document.getElementById('modal-id').value = orderId;
                document.getElementById('title-modal').value = title;
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