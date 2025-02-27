@extends('be-layouts.master')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Konfirmasi Pembayaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard-admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Konfirmasi Pembayaran</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Konfirmasi Pembayaran</h5>
                        <div class="table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Inv No</th>
                                        <th>Inv Date</th>
                                        <th>Name</th>
                                        <th>Tipe User</th>
                                        <th>Institusi Asal</th>
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
                                        <td>{{ $order->user_name }}</td>
                                        <td>{{ $order->user_tipe_user }}</td>
                                        <td>{{ $order->user_institusi_asal }}</td>
                                        <td>Rp {{ number_format($order->jumlah, 0, ',', '.') }}</td>
                                        <td>{{ $order->note }}</td>
                                        <td>{{ $order->tgl_bayar }}</td>
                                        <td>{{ $order->status == 1 ? 'Pending' : ($order->status == 2 ? 'Dibayar' : ($order->status == 3 ? 'Berhasil Dibayar' : 'Status Tidak Dikenal')) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning view-btn" data-bs-toggle="modal" data-bs-target="#viewModal">Konfirmasi</button>
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

    <div class="modal fade" id="viewModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table" style="width: 100%;">
                        <tr>
                            <td colspan="3">
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
                            <td>1230007290176 - Panitia SEMNAS IKRAITH</td>
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
                <div class="modal-footer">
                    <form id="insert-form" action="{{ url('konfirmasi-pembayaran-submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="modal-id">
                        <div class="flex items-center mt-4 text-end">
                            <button id="login-btn" type="submit" class="btn btn-success ms-3">
                                <span id="btn-text">Konfirmasi Pembayaran</span>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.datatable').addEventListener('click', function(event) {
            if (event.target.classList.contains('view-btn')) {
                const row = event.target.closest('tr');
                const orderJumlah = row.getAttribute('data-jumlah');
                const orderNote = row.getAttribute('data-note');
                const paymentProof = row.getAttribute('data-file') || 'tes';
                const orderId = row.getAttribute('data-id');

                document.getElementById('modal-id').value = orderId;
                document.getElementById('view-jumlah').textContent = 'Rp ' + new Intl.NumberFormat().format(orderJumlah);
                document.getElementById('view-note').value = orderNote;
                document.getElementById('view-bukti-pembayaran').src = paymentProof;
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
    });
</script>
@endsection