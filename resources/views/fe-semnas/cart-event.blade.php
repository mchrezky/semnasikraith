@extends('fe-layouts.master')
@section('content')
<main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('assets/img/page-title-bg.webp') }}');">
        <div class="container position-relative">
            <h1>Cart Event</h1>
            <p>
                Home
                /
                Cart Event</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Cart Event</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Blog Posts 2 Section -->
    <section id="blog-posts-2" class="blog-posts-2 section">
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 50px; text-align: center;">#</th>
                            <th style="width: 100px;">Gambar</th>
                            <th style="min-width: 200px;">Seminar</th>
                            <th style="min-width: 250px;">Judul Artikel</th>
                            <th style="min-width: 150px;">Harga</th>
                            <th style="width: 50px;" class="text-end">Aksi</th>
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
                            <td class="text-end">
                                <form id="deleteForm-{{ $event->id }}" action="{{ url('delete-event') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $event->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
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
                            <td class="text-end">
                                <form id="deleteForm-{{ $eventNon->id }}" action="{{ url('delete-event-non') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $eventNon->id }}">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $eventNon->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
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
                        <tr class="align-middle">
                            <td colspan="4" class="text-end fw-bold">Total Harga:</td>
                            <td colspan="2" class="fw-bold">Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>

                </table>

                @if(count($data['event']) > 0 || count($data['eventNon']) > 0)
                <div class="flex items-center mt-4 text-end">
                    <a class="btn btn-success ms-3" href="{{ url('/invoice-event') }}">
                        <span id="btn-text">Lanjutkan Pembayaran</span>
                    </a>
                </div>
                @else
                <div class="flex items-center mt-4 text-end">
                    <span class="text-muted">Tidak ada event untuk pembayaran.</span>
                </div>
                @endif
            </div>
        </div>
    </section>
</main>

<script>
    document.getElementById("insert-form").addEventListener("submit", function(event) {
        let loginBtn = document.getElementById("login-btn");
        let spinner = document.getElementById("spinner");
        let btnText = document.getElementById("btn-text");


        loginBtn.disabled = true;
        spinner.classList.remove("d-none");
        btnText.textContent = "Loading...";
    });
</script>
<script>
    function confirmDelete(eventId) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("deleteForm-" + eventId).submit();
            }
        });
    }
</script>
@endsection