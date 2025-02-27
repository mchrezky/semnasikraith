@extends('be-layouts.master')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Event List</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Data Event List</li>
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
                            <h5 class="card-title">Data Event List</h5>
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
                                        <th>Nama</th>
                                        <th>Type</th>
                                        <th>Semnas</th>
                                        <th>Harga</th>
                                        <th>Foto</th>
                                        <th>Keterangan</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['eventList'] as $index => $eventList)
                                    <tr class="align-middle" data-id="{{ $eventList->id }}"
                                        data-id_type="{{ $eventList->id_type }}"
                                        data-semnas_id="{{ $eventList->semnas_id }}"
                                        data-nama="{{ $eventList->nama }}"
                                        data-harga="{{ $eventList->harga }}"
                                        data-ket="{{ $eventList->ket }}"
                                        data-lat="{{ $eventList->lat }}"
                                        data-lng="{{ $eventList->lng }}">
                                        <td style="text-align: center;">{{ $index + 1 }}</td>
                                        <td>{{ $eventList->nama }}</td>
                                        <td>{{ $eventList->type_name }}</td>
                                        <td>{{ $eventList->semnas_name }}</td>
                                        <td>Rp {{ number_format($eventList->harga, 0, ',', '.') }}</td>
                                        <td><img src="{{ asset('storage/file_event_list/' . $eventList->foto) }}" alt="Bukti Pembayaran" class="img-thumbnail" style="max-width: 100px;"></td>
                                        <td>{{ $eventList->ket }}</td>
                                        <td>{{ $eventList->lat }}</td>
                                        <td>{{ $eventList->lng }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">
                                                Edit
                                            </button>
                                            <form action="{{ url('/delete-master-event-list-submit') }}" method="POST" class="delete-form d-inline">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $eventList->id }}" required readonly class="form-control">
                                                <button type="button" class="btn btn-danger delete-submit" data-id="{{ $eventList->id }}">
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
                    <form id="insert-form" action="{{ url('add-master-event-list-submit') }}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3 col-12">
                            <label for="nama">Nama <span class="text-danger">*</span></label>
                            <input id="nama" type="text" name="nama" required class="form-control" placeholder="Nama">
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="id_type">Event Type <span class="text-danger">*</span></label>
                            <select id="id_type" name="id_type" class="form-control" required>
                                <option value="" disabled selected>Select Event Type</option>
                                @foreach ($data['eventType'] as $eventType)
                                <option value="{{ $eventType->id }}">{{ $eventType->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="semnas_id">Semnas Type <span class="text-danger">*</span></label>
                            <select id="semnas_id" name="semnas_id" class="form-control" required>
                                <option value="" disabled selected>Select Semnas Type</option>
                                @foreach ($data['msSemnas'] as $msSemnas)
                                <option value="{{ $msSemnas->id }}">{{ $msSemnas->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="harga">Harga <span class="text-danger">*</span></label>
                            <input id="harga" type="number" min="0" name="harga" required class="form-control">
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="file_event_list">Foto Event <span class="text-danger">*</span></label>
                            <input id="file_event_list" type="file" name="file_event_list" class="form-control"
                                accept="image/png, image/jpeg" required>
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="ket">Keterangan <span class="text-danger">*</span></label>
                            <textarea type="text" name="ket" required class="form-control" placeholder="Keterangan"></textarea>
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="lat">Latitude <span class="text-danger">*</span></label>
                            <input id="lat" type="number" name="lat" required class="form-control" placeholder="Latitude">
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="lng">Longitude <span class="text-danger">*</span></label>
                            <input id="lng" type="number" name="lng" required class="form-control" placeholder="Longitude">
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
                    <form id="edit-form" action="{{ url('edit-master-event-list-submit') }}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3 col-12">
                            <label for="nama">Nama <span class="text-danger">*</span></label>
                            <input type="hidden" name="id" id="modal-id">
                            <input id="nama-modal" type="text" name="nama" required class="form-control" placeholder="Nama">
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="id_type">Event Type <span class="text-danger">*</span></label>
                            <select id="id_type-modal" name="id_type" class="form-control" required>
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($data['eventType'] as $eventType)
                                <option value="{{ $eventType->id }}">{{ $eventType->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="semnas_id">Semnas Type <span class="text-danger">*</span></label>
                            <select id="semnas_id-modal" name="semnas_id" class="form-control" required>
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($data['msSemnas'] as $msSemnas)
                                <option value="{{ $msSemnas->id }}">{{ $msSemnas->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="harga">Harga <span class="text-danger">*</span></label>
                            <input id="harga-modal" type="number" min="0" name="harga" required class="form-control">
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="file_event_list">Foto Event</label>
                            <input id="file_event_list" type="file" name="file_event_list" class="form-control"
                                accept="image/png, image/jpeg">
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="ket">Keterangan <span class="text-danger">*</span></label>
                            <textarea id="ket-modal" type="text" name="ket" required class="form-control" placeholder="Keterangan"></textarea>
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="lat">Latitude <span class="text-danger">*</span></label>
                            <input id="lat-modal" type="number" name="lat" required class="form-control" placeholder="Latitude">
                        </div>
                        <div class="form-group mt-3 col-12">
                            <label for="lng">Longitude <span class="text-danger">*</span></label>
                            <input id="lng-modal" type="number" name="lng" required class="form-control" placeholder="Longitude">
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
        document.querySelector('.datatable').addEventListener('click', function(event) {
            if (event.target.classList.contains('edit-btn')) {
                const row = event.target.closest('tr');
                const orderId = row.getAttribute('data-id');
                const eventTypeId = row.getAttribute('data-id_type');
                const semnasId = row.getAttribute('data-semnas_id');
                const nama = row.getAttribute('data-nama');
                const harga = row.getAttribute('data-harga');
                const ket = row.getAttribute('data-ket');
                const lat = row.getAttribute('data-lat');
                const lng = row.getAttribute('data-lng');

                document.getElementById('modal-id').value = orderId;
                document.getElementById('nama-modal').value = nama;
                document.getElementById('id_type-modal').value = eventTypeId;
                document.getElementById('semnas_id-modal').value = semnasId;
                document.getElementById('harga-modal').value = harga;
                document.getElementById('ket-modal').value = ket;
                document.getElementById('lat-modal').value = lat;
                document.getElementById('lng-modal').value = lng;
            }

            if (event.target.classList.contains('delete-submit')) {
                const form = event.target.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data event list akan dihapus.",
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
            }
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
    });
</script>