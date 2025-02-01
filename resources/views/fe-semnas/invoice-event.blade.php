@extends('fe-layouts.master')
@section('content')
<main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('assets/img/page-title-bg.webp') }}');">
        <div class="container position-relative">
            <h1>Invoice Event</h1>
            <p>
                Home
                /
                Invoice Event</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Invoice Event</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Invoice Section -->
    <section id="invoice-section" class="invoice-section section">
        <div class="container">
            <div class="table-responsive">
                <div class="invoice-box">
                    <!-- Company Logo and Invoice Info -->
                    <div class="invoice-header">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Company Logo" class="invoice-logo">
                        <div class="header-content">
                            <div class="invoice-details">
                                <h2>Invoice</h2>
                                <p>Invoice Number: {{ $data['event'][0]->order_id }}</p>
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
                                <td>Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <!-- Payment Info and Footer -->
                    <div class="payment-footer-container">
                        <div class="payment-info">
                            <h3>Payment Information</h3>
                            <p>Account No: 123567744{{ substr(Auth::user()->no_telp, -3) }}</p>
                            <p>Due By: {{ now()->addDays(7)->format('F jS, Y') }}</p>
                            <p><strong style="color: red;">Due: Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong></p>
                        </div>
                        <div class="invoice-footer">
                            <p>Thank you for your business!</p>
                            <p>hello@useanvil.com | 555 444 6666 | useanvil.com</p>
                        </div>
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