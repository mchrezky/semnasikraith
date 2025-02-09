@extends('fe-layouts.master')

@section('content')
<main class="main">

    <!-- Invoice Section -->
    <section id="invoice-section" class="invoice-section section">
        <div class="container">
            <div class="table-responsive">
                <div class="invoice-box">
                    <h1>Data Pemakalah</h1>
                    <hr>
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
                            <tr class="align-middle" data-id="{{ $event->nama }}" data-jumlah="{{ $event->title }}" data-note="{{ $event->date }}">
                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                <td>{{ $event->nama }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->date }}</td>
                                <td>{{ $event->konfirmasi_bayar == 1 ? 'Pending' : ($event->konfirmasi_bayar == 2 ? 'Dibayar' : ($event->konfirmasi_bayar == 3 ? 'Berhasil Dibayar' : 'Selesai')) }}</td>
                                <td>
                                    @if ($event->konfirmasi_bayar == 4)
                                    <button type="button" class="btn btn-info view-btn" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="bi bi-eye"></i> View</button>
                                    @else
                                    <button type="button" class="btn btn-warning edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h1>Data Non Pemakalah</h1>
                    <hr>
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
                                <td>{{ $eventnon->konfirmasi_bayar == 1 ? 'Pending' : ($eventnon->konfirmasi_bayar == 2 ? 'Dibayar' : ($eventnon->konfirmasi_bayar == 3 ? 'Berhasil Dibayar' : 'Selesai')) }}</td>
                                <td>
                                    @if ($eventnon->konfirmasi_bayar == 4)
                                    <button type="button" class="btn btn-info view-btn" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="bi bi-eye"></i> View</button>
                                    @else
                                    <button type="button" class="btn btn-warning edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Data Pemakalah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insert-form" action="{{ url('update-pembayaran-submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        Under Development
                        <input type="hidden" name="id" id="modal-id">
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">View Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table" style="width: 100%;">
                        <tr>
                            <td>
                                <h3>Payment Information</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>Bank</td>
                            <td>:</td>
                            <td>Bank Mandiri</td>
                        </tr>
                        <tr>
                            <td>Bank Account</td>
                            <td>:</td>
                            <td>1230007290176 - Panitia SEMNAS IKRAITH </td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>:</td>
                            <td><strong style="color: red;" id="view-jumlah">Rp 0</strong></td>
                        </tr>
                        <tr>
                            <td>File Bukti Pembayaran</td>
                            <td>:</td>
                            <td><img id="view-bukti-pembayaran" class="img-fluid" alt="Bukti Pembayaran" /></td>
                        </tr>
                        <tr>
                            <td>Note</td>
                            <td>:</td>
                            <td><textarea id="view-note" class="form-control" readonly></textarea></td>
                        </tr>
                    </table>
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
            const orderJumlah = row.getAttribute('data-jumlah');
            const orderNote = row.getAttribute('data-note');
            const orderTglBayar = row.getAttribute('data-tgl_bayar');

            document.getElementById('modal-id').value = orderId;
            document.getElementById('modal-jumlah').textContent = 'Rp ' + new Intl.NumberFormat().format(orderJumlah);
            document.getElementById('modal-note').value = orderNote;
        });
    });

    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const orderId = row.getAttribute('data-id');
            const orderJumlah = row.getAttribute('data-jumlah');
            const orderNote = row.getAttribute('data-note');
            const orderTglBayar = row.getAttribute('data-tgl_bayar');
            const orderStatus = row.getAttribute('data-status');
            const paymentProof = row.getAttribute('data-file');

            document.getElementById('view-jumlah').textContent = 'Rp ' + new Intl.NumberFormat().format(orderJumlah);
            document.getElementById('view-note').value = orderNote;
            document.getElementById('view-bukti-pembayaran').src = paymentProof || 'tes';
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