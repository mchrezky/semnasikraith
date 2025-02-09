@extends('fe-layouts.master')
@section('content')
<main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('assets/img/head.jpg') }}');">
        <div class="container position-relative">
            <h1>Events</h1>
            <p>
                Home
                /
                Events</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Events</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Blog Posts 2 Section -->
    <section id="blog-posts-2" class="blog-posts-2 section">

        <div class="container">
            <div class="row gy-4">
                @foreach ($data['event'] as $index => $item)
                <div class="col-lg-4"> <!-- Tambahkan d-flex agar card memiliki tinggi yang sama -->
                    <article class="position-relative h-100 d-flex flex-column shadow-lg rounded">

                        <div class="post-img position-relative overflow-hidden">
                            <img src="{{ asset('assets/img/event/' . $item->foto) }}" class="img-fluid w-100" style="height: 200px; object-fit: cover;" alt="">
                        </div>

                        <div class="meta d-flex align-items-end p-3">
                            <span class="post-date"><span>{{ sprintf('%02d', $index + 1) }}</span> Event</span>
                            <div class="d-flex align-items-center ms-3">
                                <i class="bi bi-tags"></i> <span class="ps-2">{{ $item->type_name }}</span>
                            </div>
                            <span class="px-3 text-black-50">/</span>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-cash-coin"></i> <span class="ps-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="post-content d-flex flex-column flex-grow-1 p-3">
                            <h3 class="post-title">{{ $item->nama }}<br><sub>{{ $item->semnas_name }}</sub></h3>
                            
                            <a href="{{ url('create-event/' . $item->id) }}" class="readmore stretched-link mt-auto"><span>Daftar Sekarang</span><i class="bi bi-arrow-right"></i></a>
                        </div>

                    </article>
                </div>
                @endforeach
            </div>
        </div>

    </section><!-- /Blog Posts 2 Section -->

    <!-- Blog Pagination Section -->
    <section id="blog-pagination" class="blog-pagination section">
        <div class="container">
            <div class="d-flex justify-content-center">
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($data['event']->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link"><i class="bi bi-chevron-left"></i></span>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="{{ $data['event']->previousPageUrl() }}" class="page-link"><i class="bi bi-chevron-left"></i></a>
                    </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @php
                    $currentPage = $data['event']->currentPage();
                    $lastPage = $data['event']->lastPage();
                    @endphp

                    @if ($currentPage > 3)
                    <li class="page-item"><a href="{{ $data['event']->url(1) }}" class="page-link">1</a></li>
                    @if ($currentPage > 4)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                    @endif

                    @foreach ($data['event']->getUrlRange(max(1, $currentPage - 2), min($lastPage, $currentPage + 2)) as $page => $url)
                    @if ($page == $currentPage)
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                    <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                    @endif
                    @endforeach

                    @if ($currentPage < $lastPage - 2)
                        @if ($currentPage < $lastPage - 3)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif
                        <li class="page-item"><a href="{{ $data['event']->url($lastPage) }}" class="page-link">{{ $lastPage }}</a></li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($data['event']->hasMorePages())
                        <li class="page-item">
                            <a href="{{ $data['event']->nextPageUrl() }}" class="page-link"><i class="bi bi-chevron-right"></i></a>
                        </li>
                        @else
                        <li class="page-item disabled">
                            <span class="page-link"><i class="bi bi-chevron-right"></i></span>
                        </li>
                        @endif
                </ul>
            </div>
        </div>
    </section><!-- /Blog Pagination Section -->
</main>
@endsection