@extends('fe-layouts.master')
@section('content')
<main class="main">

    <!-- Invoice Section -->
    <section id="invoice-section" class="invoice-section section">
        <div class="container">
            <div class="table-responsive">
                <div class="invoice-box">
                    <!-- Company Logo and Invoice Info -->
                    <div class="invoice-header">
                        <!--<img src="{{ asset('assets/img/logo.png') }}" alt="Company Logo" class="invoice-logo">-->
                        <div class="header-content">
                            <div class="invoice-details">
                                <h2>Invoice</h2>
                                @if(isset($data['event'][0]->order_id))
                                <p>Invoice Number: {{ $data['event'][0]->order_id }}</p>
                                @elseif(isset($data['eventNon'][0]->order_id))
                                <p>Invoice Number: {{ $data['eventNon'][0]->order_id }}</p>
                                @else
                                <p>Invoice Number: Tidak tersedia</p>
                                @endif
                                <p>Invoice Date: {{ now()->format('F jS, Y') }}</p>
                            </div>
                            <div class="client-info">
                                <h3>Client Information</h3>
                                <p>Client Name: {{ Auth::user()->name }}</p>
                                <p>Email: {{ Auth::user()->email }}</p>
                                <p>Phone: {{ Auth::user()->no_telp }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <!-- Purchased Events List -->
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Gambar</th>
                                <th>Seminar</th>
                                <th>Judul Artikel</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalHarga = 0;
                            $allEventsEmpty = empty($data['event']) && empty($data['eventNon']);
                            @endphp

                            <!-- Event -->
                            @forelse($data['event'] as $index => $event)
                            @php $totalHarga += $event->event_harga; @endphp
                            <tr class="align-middle">
                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ asset('assets/img/event/' . $event->event_foto) }}"
                                        class="img-fluid"
                                        style="max-width: 100px; max-height: 100px; object-fit: cover;"
                                        alt="Event Image">
                                </td>
                                <td>
                                    <h5 class="content-title mb-4">{{ $event->seminar_name }}</h5>
                                    <span class="badge bg-success">{{ $event->type_name }}</span>
                                </td>
                                <td>{{ $event->title }}</td>
                                <td>Rp {{ number_format($event->event_harga, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <!-- Gak ada udah -->
                            @endforelse

                            <!-- Event Non -->
                            @forelse($data['eventNon'] as $index => $eventNon)
                            @php $totalHarga += $eventNon->event_harga; @endphp
                            <tr class="align-middle">
                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ asset('assets/img/event/' . $eventNon->event_foto) }}"
                                        class="img-fluid"
                                        style="max-width: 100px; max-height: 100px; object-fit: cover;"
                                        alt="Event Image">
                                </td>
                                <td>
                                    <h5 class="content-title mb-4">{{ $eventNon->seminar_name }}</h5>
                                    <span class="badge bg-success">{{ $eventNon->type_name }}</span>
                                </td>
                                <td>Tidak Ada</td>
                                <td>Rp {{ number_format($eventNon->event_harga, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <!-- Gak ada udah -->
                            @endforelse

                            @if ($allEventsEmpty)
                            <tr>
                                <td colspan="6" class="text-center">Belum ada event.</td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end">Total Harga:</td>
                                <td>Rp {{ number_format($totalHarga+substr(Auth::user()->no_telp, -3), 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <!-- Payment Info and Footer -->
                    <div class="payment-footer-container">
                        <div class="payment-info">

                            <form id="insert-form" action="{{ url('create-pembayaran-submit') }}" method="post" role="form" enctype="multipart/form-data">
                                @csrf
                                <input id="id" type="hidden" name="id"
                                    value="{{ isset($data['event'][0]->order_id) ? $data['event'][0]->order_id : (isset($data['eventNon'][0]->order_id) ? $data['eventNon'][0]->order_id : '') }}"
                                    required class="form-control" placeholder="id">
                                <input id="jumlah" type="hidden" name="jumlah" value="{{ $totalHarga+substr(Auth::user()->no_telp, -3) }}" required class="form-control" placeholder="jumlah">
                                <table class="table" style="width: 100%;">
                                    <tr>
                                        <td>
                                            <h3>Payment Information</h3>
                                        </td>
                                        <td></td>
                                        <td></td>
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
                                        <td><strong style="color: red;">Rp {{ number_format($totalHarga+substr(Auth::user()->no_telp, -3), 0, ',', '.') }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="32">
                                            <div class="flex items-center mt-4 text-end">
                                                <button type="submit" class="btn btn-success ms-3">
                                                    <span id="btn-text">Submit Pembayaran</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <!--<div class="invoice-footer">-->
                        <!--    <p>Thank you for your business!</p>-->
                        <!--    <p>hello@useanvil.com | 555 444 6666 | useanvil.com</p>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

<style>
    .invoice-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .invoice-logo {
        max-width: 150px;
        margin-right: 20px;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .invoice-details,
    .client-info {
        flex: 1;
    }

    .client-info {
        text-align: right;
    }

    .payment-footer-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-top: 20px;
    }

    .invoice-footer {
        text-align: right;
    }
</style>