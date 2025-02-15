@extends('be-layouts.master')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Jadwal</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Data Jadwal</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Jadwal</h5>
                        <div class="table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Date Start</th>
                                        <th>Date End</th>
                                        <th>Keterangan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['jadwal'] as $index => $jadwal)
                                    <tr class="align-middle" data-id="{{ $jadwal->id }}" data-title="{{ $jadwal->title }}" data-date_start="{{ $jadwal->date_start }}" data-date_end="{{ $jadwal->date_end }}" data-ket="{{ $jadwal->ket }}">
                                        <td style="text-align: center;">{{ $index + 1 }}</td>
                                        <td>{{ $jadwal->title }}</td>
                                        <td>{{ $jadwal->date_start }}</td>
                                        <td>{{ $jadwal->date_end }}</td>
                                        <td>{{ $jadwal->ket }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">
                                                Edit
                                            </button>
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

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insert-form" action="{{ url('edit-master-jadwal-submit') }}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3 col-12">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input id="title-modal" type="text" name="title" required class="form-control" placeholder="Title">
                            <input id="modal-id" type="hidden" name="id" required class="form-control">
                        </div>

                        <div class="row">
                            <div class="form-group col-12">
                                <div class="row">
                                    <div class="form-group mt-3 col-sm-12 col-md-6">
                                        <label for="date_start">Date Start <span class="text-danger">*</span></label>
                                        <input id="date_start-modal" type="date" name="date_start" required class="form-control" placeholder="Date Start"></input>
                                    </div>
                                    <div class="form-group mt-3 col-sm-12 col-md-6">
                                        <label for="date_end">Date End <span class="text-danger">*</span></label>
                                        <input id="date_end-modal" type="date" name="date_end" required class="form-control" placeholder="Date End"></input>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3 col-12">
                            <label for="ket">Keterangan<span class="text-danger">*</span></label>
                            <textarea id="ket-modal" type="text" name="ket" required class="form-control" placeholder="Keterangan"></textarea>
                        </div>

                        <div class="flex items-center mt-4 d-flex justify-content-end">
                            <button id="login-btn" type="submit" class="btn btn-success ms-3">
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
</main><!-- End #main -->
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const jadwalId = row.getAttribute('data-id');
                const title = row.getAttribute('data-title');
                const dateStart = row.getAttribute('data-date_start');
                const dateEnd = row.getAttribute('data-date_end');
                const ket = row.getAttribute('data-ket');

                document.getElementById('modal-id').value = jadwalId;
                document.getElementById('title-modal').value = title;
                document.getElementById('date_start-modal').value = dateStart;
                document.getElementById('date_end-modal').value = dateEnd;
                document.getElementById('ket-modal').value = ket;
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
    });
</script>