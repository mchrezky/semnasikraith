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
                                <th>Status Review</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['event'] as $index => $event)
                            <tr class="align-middle" data-id="{{ $event->id }}" data-abstrak="{{ $event->abstrak }}" data-metode_penelitian="{{ $event->metode_penelitian }}" data-pembahasan="{{ $event->pembahasan }}" data-kesimpulan="{{ $event->kesimpulan }}" data-plagriasi_turnitin="{{ $event->plagriasi_turnitin }}" data-ket_review="{{ $event->ket_review }}" data-file_loa="{{ $event->file_loa }}">
                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                <td>{{ $event->nama }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->date }}</td>
                                <td>{{ $event->konfirmasi_bayar == 1 ? 'Pending' : ($event->konfirmasi_bayar == 2 ? 'Dibayar' : ($event->konfirmasi_bayar == 3 ? 'Berhasil Dikonfirmasi' : 'Selesai')) }}</td>
                                <td>
                                    @if ($event->review == 'Baru')
                                    <span class="badge rounded-pill bg-secondary">Makalah Baru</span>
                                    @elseif ($event->review == 'Telah Direview')
                                    <span class="badge rounded-pill bg-warning text-dark">Sudah Direview</span>
                                    @elseif ($event->review == 'Telah Direvisi')
                                    <span class="badge rounded-pill bg-primary">Sudah Direvisi</span>
                                    @elseif ($event->review == 'Selesai')
                                    <span class="badge rounded-pill bg-success">Sudah ACC</span>
                                    @else
                                    <span class="badge rounded-pill bg-dark">{{ $event->review }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($event->review == 'Baru' || $event->review == 'Telah Direview')
                                    <button type="button" title="Edit" class="btn btn-warning">
                                        <i class="bi bi-pencil text-white edit-btn fs-5" data-bs-toggle="modal" data-bs-target="#editModal"></i>
                                    </button>
                                    @endif
                                    @if($event->konfirmasi_bayar == 3)
                                    <a class="btn btn-success" title="Download" target="_blank" href="{{ url('/download-sertifikat-data-pemakalah/' . $event->id) }}">
                                        <i class="bi bi-download fs-5"></i>
                                    </a>
                                    @endif
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
                                <th>Opsi</th>
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
                                <td>
                                    @if($eventnon->konfirmasi_bayar == 3)
                                    <a class="btn btn-success" title="Download" target="_blank" href="{{ url('/download-sertifikat-data-non-pemakalah/' . $eventnon->id) }}">
                                        <i class="bi bi-download fs-5"></i>
                                    </a>
                                    @endif
                                </td>
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
                    <h5 class="modal-title" id="editModalLabel">Revisi Data Pemakalah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insert-form" action="{{ url('edit-event-submit') }}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        <h5 class="card-title text-center">Hasil Review</h5>
                        <div class="row">
                            <div class="form-group mt-3 col-12">
                                <div class="border p-3 bg-light">
                                    <div class="row">
                                        <div class="form-group mt-3 col-sm-12 col-md-6">
                                            <label for="abstrak">Review Abstrak <span class="text-danger">*</span></label>
                                            <textarea id="abstrak-modal" type="text" name="abstrak" required class="form-control" placeholder="Review Abstrak" readonly></textarea>
                                        </div>
                                        <div class="form-group mt-3 col-sm-12 col-md-6">
                                            <label for="metode_penelitian">Review Metode Penelitian <span class="text-danger">*</span></label>
                                            <textarea id="metode_penelitian-modal" type="text" name="metode_penelitian" required class="form-control" placeholder="Review Metode Penelitian" readonly></textarea>
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
                                            <label for="pembahasan">Review Pembahasan <span class="text-danger">*</span></label>
                                            <textarea id="pembahasan-modal" type="text" name="pembahasan" required class="form-control" placeholder="Review Pembahasan" readonly></textarea>
                                        </div>
                                        <div class="form-group mt-3 col-sm-12 col-md-6">
                                            <label for="kesimpulan">Review Kesimpulan <span class="text-danger">*</span></label>
                                            <textarea id="kesimpulan-modal" type="text" name="kesimpulan" required class="form-control" placeholder="Review Kesimpulan" readonly></textarea>
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
                                            <label for="plagriasi_turnitin">Review Plagriasi Turnitin <span class="text-danger">*</span></label>
                                            <textarea id="plagriasi_turnitin-modal" type="text" name="plagriasi_turnitin" required class="form-control" placeholder="Review Plagriasi Turnitin" readonly></textarea>
                                        </div>
                                        <div class="form-group mt-3 col-sm-12 col-md-6">
                                            <label for="ket_review">Keterangan Review <span class="text-danger">*</span></label>
                                            <textarea id="ket_review-modal" type="text" name="ket_review" required class="form-control" placeholder="Keterangan Review" readonly></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3 col-12">
                            <div class="border p-3 bg-light">
                                <label for="file_loa">File LOA</label>
                                <div class="d-flex align-items-center">
                                    <a id="file_loa-modal" href="#"
                                        target="_blank"
                                        class="btn btn-outline-primary fw-bold px-4 py-2 shadow-sm rounded-pill">
                                        <i class="fas fa-file-pdf me-2"></i> Lihat File
                                    </a>
                                </div>
                            </div>
                        </div>

                        <h5 class="card-title text-center mt-5">Revisi Data Pemakalah</h5>
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
                                <span id="btn-text">Revisi Data</span>
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
            const abstrak = row.getAttribute('data-abstrak');
            const metodePenelitian = row.getAttribute('data-metode_penelitian');
            const pembahasan = row.getAttribute('data-pembahasan');
            const kesimpulan = row.getAttribute('data-kesimpulan');
            const plagiasiTurnitin = row.getAttribute('data-plagriasi_turnitin');
            const ketReview = row.getAttribute('data-ket_review');
            const fileLoa = row.getAttribute('data-file_loa');

            document.getElementById('modal-id').value = orderId;
            document.getElementById('abstrak-modal').value = abstrak;
            document.getElementById('metode_penelitian-modal').value = metodePenelitian;
            document.getElementById('pembahasan-modal').value = pembahasan;
            document.getElementById('kesimpulan-modal').value = kesimpulan;
            document.getElementById('plagriasi_turnitin-modal').value = plagiasiTurnitin;
            document.getElementById('ket_review-modal').value = ketReview;
            const fileLoaUrl = "{{ asset('storage/file_loa/') }}/" + fileLoa;

            if (fileLoa) {
                document.getElementById('file_loa-modal').href = fileLoaUrl;
                document.getElementById('file_loa-modal').textContent = 'Lihat File';
            } else {
                document.getElementById('file_loa-modal').href = '#';
                document.getElementById('file_loa-modal').textContent = 'File Belum Diupload';
                document.getElementById('file_loa-modal').classList.add('disabled');
            }
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