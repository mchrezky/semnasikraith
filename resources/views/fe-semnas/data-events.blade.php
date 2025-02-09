@extends('fe-layouts.master')

@section('content')
<main class="main">

    <!-- Invoice Section -->
    <section id="invoice-section" class="invoice-section section">
        <div class="container">
            <div class="invoice-box">
                <h1>Data Pemakalah</h1>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Event</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['event'] as $index => $event)
                            <tr class="align-middle" data-id="{{ $event->id }}">
                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                <td>{{ $event->nama }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->date }}</td>
                                <td>{{ $event->konfirmasi_bayar == 1 ? 'Pending' : ($event->konfirmasi_bayar == 2 ? 'Dibayar' : ($event->konfirmasi_bayar == 3 ? 'Berhasil Dikonfirmasi' : 'Selesai')) }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h1>Data Non Pemakalah</h1>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Event</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['eventnon'] as $index => $eventnon)
                            <tr class="align-middle" data-id="{{ $eventnon->nama_lengkap }}" data-jumlah="{{ $eventnon->title }}" data-note="{{ $eventnon->date }}">
                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                <td>{{ $eventnon->nama }}</td>
                                <td>{{ $eventnon->nama_lengkap }}</td>
                                <td>{{ $eventnon->date }}</td>
                                <td>{{ $eventnon->konfirmasi_bayar == 1 ? 'Pending' : ($eventnon->konfirmasi_bayar == 2 ? 'Dibayar' : ($eventnon->konfirmasi_bayar == 3 ? 'Berhasil Dikonfirmasi' : 'Selesai')) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Pemakalah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insert-form" action="{{ url('edit-event-submit') }}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3 col-12">
                            <div class="row">
                                <div class="form-group mt-3 col-12">
                                    <div class="border p-3 bg-light">
                                        <div class="row">
                                            <!-- Turnitin Result (col 6) -->
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="hasil_cek_turnitin">Hasil cek Turnitin (maks 20%) <span class="text-danger">*</span></label>
                                                <input id="hasil_cek_turnitin" type="number" name="hasil_cek_turnitin" class="form-control" placeholder="Masukkan Hasil Cek Turnitin" max="20" required>
                                                <input type="hidden" name="id" id="modal-id">
                                            </div>

                                            <!-- Turnitin File (col 6) -->
                                            <div class="form-group mt-3 col-sm-12 col-md-6">
                                                <label for="file_hasil_cek_turnitin">File Hasil Cek Turnitin (PDF Maksimal 10MB) <span class="text-danger">*</span></label>
                                                <input id="file_hasil_cek_turnitin" type="file" name="file_hasil_cek_turnitin" class="form-control" accept="application/pdf" required>
                                                <small class="text-muted">Maksimal ukuran file: 10MB, hanya PDF</small>
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
                                            <!-- Turnitin File (col 6) -->
                                            <div class="form-group mt-3 col-sm-12 col-md-12">
                                                <label for="file_ojs">File OJS (PDF Maksimal 10MB) <span class="text-danger">*</span></label>
                                                <input id="file_ojs" type="file" name="file_ojs" class="form-control" accept="application/pdf" required>
                                                <small class="text-muted">Maksimal ukuran file: 10MB, hanya PDF</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
</main>

<script>
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const orderId = row.getAttribute('data-id');

            document.getElementById('modal-id').value = orderId;
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
</script>
@endsection