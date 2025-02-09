@extends('fe-layouts.master')

@section('content')
<main class="main">

    <!-- Invoice Section -->
    <section id="invoice-section" class="invoice-section section">
        <div class="container">
            <div class="table-responsive">
                <div class="invoice-box">
                    <h1>Riwayat Pembayaran</h1>
                    <hr>

                    <!-- Purchased Events List -->
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Inv No</th>
                                <th>Inv Date</th>
                                <th>Jumlah</th>
                                <th>Note</th>
                                <th>Tgl Bayar</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['order'] as $index => $order)
                            <tr class="align-middle" data-id="{{ $order->id }}" data-jumlah="{{ $order->jumlah }}" data-note="{{ $order->note }}" data-tgl_bayar="{{ $order->tgl_bayar }}" data-file="{{ asset('storage/file_bukti_pembayaran/' . $order->file) }}">
                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>Rp {{ number_format($order->jumlah, 0, ',', '.') }}</td>
                                <td>{{ $order->note }}</td>
                                <td>{{ $order->tgl_bayar }}</td>
                                <td>{{ $order->status == 1 ? 'Pending' : ($order->status == 2 ? 'Dibayar' : ($order->status == 3 ? 'Berhasil Dibayar' : 'Status Tidak Dikenal')) }}</td>
                                <td>
                                    @if ($order->status == 2)
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
                    <h5 class="modal-title" id="editModalLabel">Edit Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insert-form" action="{{ url('update-pembayaran-submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="modal-id">
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
                                <td>1237290176 - Panitia SEMNAS IKRAITH </td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>:</td>
                                <td><strong style="color: red;" id="modal-jumlah">Rp 0</strong></td>
                            </tr>
                            <tr>
                                <td>File Bukti Pembayaran (PNG, JPG, atau PDF Maksimal 10MB) <span class="text-danger">*</span></td>
                                <td>:</td>
                                <td> <input id="file_bukti_pembayaran" type="file" name="file_bukti_pembayaran" class="form-control"
                                        accept="application/pdf, image/png, image/jpeg" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Note</td>
                                <td>:</td>
                                <td> <textarea id="modal-note" name="note" class="form-control" placeholder="Note Pembayaran"></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="32">
                                    <div class="flex items-center mt-4 text-end">
                                        <button id="login-btn" type="submit" class="btn btn-success ms-3">
                                            <span id="btn-text">Submit Pembayaran</span>
                                            <div id="spinner" class="spinner-border spinner-border-sm d-none" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </table>
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
            const paymentProof = '' + row.getAttribute('data-file');

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