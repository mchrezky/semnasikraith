@extends('fe-layouts.master')
@section('content')
<main class="main">

  <!-- Section Title -->
  <center>
    <div data-aos="fade-up">
      <div class="alert alert-info" role="alert"><strong>10 paper terbaik akan memperoleh : sertifikat best paper + akun SuperAI🔥🔥</strong>
      </div>
    </div><!-- End Section Title -->
  </center>
  <!-- Hero Section -->
  <section id="hero" class="hero section dark-background">

    <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

      @foreach ($data['banner'] as $index => $item)
      <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
        <img src="{{ asset('storage/file_banner/' . $item->foto) }}" alt="">
        <div class="carousel-container">
          <!--<h2>Farming is the best solution of worlds starvation</h2>-->
          <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>-->
        </div>
      </div><!-- End Carousel Item -->

      @endforeach

      <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

      <ol class="carousel-indicators"></ol>

    </div>

  </section>
  <!-- /Hero Section -->

  <!-- Services Section -->
  <section id="services" class="services section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>TIMELINE</h2>
      <p>Alur Pendaftaran Seminar Nasional 2025</p>
    </div><!-- End Section Title -->
    <div class="content">
      <div class="container">
        <div class="row g-0">
          @foreach ($data['jadwal'] as $index => $item)
          @if ($index < 3)
            <div class="col-lg-4 col-md-6">
            <div class="service-item">
              <center>
                <!--<span class="number">{{ sprintf('%02d', $index + 1) }}</span>-->
                <div class="service-item-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="80" height="80" x="0" y="0" viewBox="0 0 514.314 514.314" style="enable-background: new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                      <path d="M434.176 51.297h72.639c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-72.639c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5zM117.994 54.791h30.852c5.47 6.605 13.729 10.82 22.955 10.82h42.865l35.886 35.886c8.246 8.246 19.209 12.787 30.869 12.787h8.32c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-8.32c-7.654 0-14.85-2.981-20.262-8.393l-38.083-38.083a7.5 7.5 0 0 0-5.304-2.197H171.8c-8.159 0-14.797-6.638-14.797-14.797s6.638-14.797 14.797-14.797h123.757a66.756 66.756 0 0 1 35.416 10.157l30.374 18.983a7.497 7.497 0 0 0 3.975 1.14h36.891c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-34.739l-28.551-17.843a81.742 81.742 0 0 0-43.365-12.437H171.801c-16.43 0-29.797 13.367-29.797 29.798 0 1.349.099 2.675.273 3.977h-24.283a7.5 7.5 0 1 0 0 14.999zM30.38 144.476h20.344a29.724 29.724 0 0 0-4.003 14.921c0 14.399 10.225 26.453 23.795 29.288a29.746 29.746 0 0 0-4.371 15.555c0 16.499 13.423 29.921 29.921 29.921h131.637a7.5 7.5 0 0 0 7.498-7.688 7.5 7.5 0 0 0-8.307-7.311H96.065c-8.228 0-14.921-6.694-14.921-14.921s6.693-14.921 14.921-14.921H163.9c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5H76.643c-8.228 0-14.922-6.694-14.922-14.921s6.694-14.921 14.922-14.921H163.9c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5H30.38c-8.228 0-14.921-6.694-14.921-14.921s6.693-14.921 14.921-14.921H163.9c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5H62.547c-8.228 0-14.921-6.694-14.921-14.921s6.693-14.921 14.921-14.921h23.485c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5H62.547c-16.498 0-29.921 13.423-29.921 29.921a29.719 29.719 0 0 0 4.003 14.921H30.38C13.882 84.636.459 98.059.459 114.557s13.423 29.919 29.921 29.919zM506.814 196.74H389.248a7.497 7.497 0 0 0-4.629 1.599l-5.613 4.403c-13.495 10.588-30.375 16.42-47.529 16.42h-12.272a7.5 7.5 0 0 0-8.309 7.5 7.5 7.5 0 0 0 7.5 7.5h13.081c20.496 0 40.664-6.967 56.788-19.618l3.574-2.804h114.976a7.5 7.5 0 1 0-.001-15z" fill="currentColor" opacity="1" data-original="currentColor" class=""></path>
                      <path d="M192.215 150.164c0 15.372 12.506 27.878 27.878 27.878s27.879-12.506 27.879-27.878-12.507-27.878-27.879-27.878-27.878 12.506-27.878 27.878zm40.757 0c0 7.101-5.777 12.878-12.879 12.878-7.101 0-12.878-5.777-12.878-12.878s5.777-12.878 12.878-12.878c7.101-.001 12.879 5.777 12.879 12.878zM273.049 203.771c-12.599 0-22.848 10.25-22.848 22.848s10.249 22.847 22.848 22.847 22.848-10.249 22.848-22.847-10.25-22.848-22.848-22.848zm0 30.695c-4.327 0-7.848-3.52-7.848-7.847s3.521-7.848 7.848-7.848 7.848 3.521 7.848 7.848-3.521 7.847-7.848 7.847zM474.178 493.298h-9.202l-73.199-62.323c-3.155-2.686-7.888-2.305-10.573.849s-2.305 7.887.849 10.572l59.785 50.902H43.105l108.164-92.092a77.855 77.855 0 0 1 50.423-18.558h81.558a77.851 77.851 0 0 1 50.423 18.558l24.029 20.458a7.498 7.498 0 0 0 10.573-.849 7.5 7.5 0 0 0-.849-10.572l-24.029-20.458a92.867 92.867 0 0 0-60.147-22.137h-51.158v-26.806h15.44c24.205 0 43.896-19.692 43.896-43.897v-8.808c0-6.785-5.52-12.305-12.305-12.305h-18.135c-19.99 0-36.891 13.437-42.174 31.749-5.716-4.945-13.156-7.947-21.29-7.947h-15.061c-6.942 0-12.591 5.648-12.591 12.592v7.399c0 17.97 14.619 32.589 32.589 32.589h14.629v15.433h-15.399a92.867 92.867 0 0 0-60.147 22.137L19.967 493.298H7.5c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h466.678a7.5 7.5 0 0 0 0-15zM232.092 319.73c0-15.934 12.963-28.897 28.897-28.897h15.439v6.112c0 15.934-12.963 28.897-28.896 28.897h-15.44zm-16.978 17.485h-12.651c-9.698 0-17.589-7.89-17.589-17.589v-4.991h12.651c9.698 0 17.589 7.89 17.589 17.589z" fill="currentColor" opacity="1" data-original="currentColor" class=""></path>
                      <path d="M178.358 429.065c0 13.218 10.754 23.972 23.972 23.972s23.972-10.753 23.972-23.972-10.754-23.972-23.972-23.972-23.972 10.753-23.972 23.972zm32.944 0c0 4.947-4.024 8.972-8.972 8.972s-8.972-4.025-8.972-8.972 4.024-8.972 8.972-8.972 8.972 4.024 8.972 8.972zM252.23 445.536c0 15.706 12.777 28.484 28.483 28.484s28.484-12.778 28.484-28.484-12.778-28.484-28.484-28.484-28.483 12.778-28.483 28.484zm41.968 0c0 7.435-6.049 13.484-13.484 13.484s-13.483-6.049-13.483-13.484 6.049-13.484 13.483-13.484c7.435 0 13.484 6.049 13.484 13.484z" fill="currentColor" opacity="1" data-original="currentColor" class=""></path>
                    </g>
                  </svg>
                </div>
                <div class="service-item-content">
                  <h3 class="service-heading">{{ $item->title }}</h3>
                  <span class="badge bg-success mb-2">{{ \Carbon\Carbon::parse($item->date_start)->format('d F Y') }} - {{ \Carbon\Carbon::parse($item->date_end)->format('d F Y') }}</span>
                  <!--<p>{{ $item->ket }}</p>-->
                </div>
              </center>
            </div>
        </div>
        @else
        <div class="col-lg-6 col-md-6">
          <div class="service-item h-100">
            <center>
              <!--<span class="number">{{ sprintf('%02d', $index + 1) }}</span>-->
              <div class="service-item-icon">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="80" height="80" x="0" y="0" viewBox="0 0 514.314 514.314" style="enable-background: new 0 0 512 512" xml:space="preserve" class="">
                  <g>
                    <path d="M434.176 51.297h72.639c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-72.639c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5zM117.994 54.791h30.852c5.47 6.605 13.729 10.82 22.955 10.82h42.865l35.886 35.886c8.246 8.246 19.209 12.787 30.869 12.787h8.32c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-8.32c-7.654 0-14.85-2.981-20.262-8.393l-38.083-38.083a7.5 7.5 0 0 0-5.304-2.197H171.8c-8.159 0-14.797-6.638-14.797-14.797s6.638-14.797 14.797-14.797h123.757a66.756 66.756 0 0 1 35.416 10.157l30.374 18.983a7.497 7.497 0 0 0 3.975 1.14h36.891c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-34.739l-28.551-17.843a81.742 81.742 0 0 0-43.365-12.437H171.801c-16.43 0-29.797 13.367-29.797 29.798 0 1.349.099 2.675.273 3.977h-24.283a7.5 7.5 0 1 0 0 14.999zM30.38 144.476h20.344a29.724 29.724 0 0 0-4.003 14.921c0 14.399 10.225 26.453 23.795 29.288a29.746 29.746 0 0 0-4.371 15.555c0 16.499 13.423 29.921 29.921 29.921h131.637a7.5 7.5 0 0 0 7.498-7.688 7.5 7.5 0 0 0-8.307-7.311H96.065c-8.228 0-14.921-6.694-14.921-14.921s6.693-14.921 14.921-14.921H163.9c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5H76.643c-8.228 0-14.922-6.694-14.922-14.921s6.694-14.921 14.922-14.921H163.9c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5H30.38c-8.228 0-14.921-6.694-14.921-14.921s6.693-14.921 14.921-14.921H163.9c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5H62.547c-8.228 0-14.921-6.694-14.921-14.921s6.693-14.921 14.921-14.921h23.485c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5H62.547c-16.498 0-29.921 13.423-29.921 29.921a29.719 29.719 0 0 0 4.003 14.921H30.38C13.882 84.636.459 98.059.459 114.557s13.423 29.919 29.921 29.919zM506.814 196.74H389.248a7.497 7.497 0 0 0-4.629 1.599l-5.613 4.403c-13.495 10.588-30.375 16.42-47.529 16.42h-12.272a7.5 7.5 0 0 0-8.309 7.5 7.5 7.5 0 0 0 7.5 7.5h13.081c20.496 0 40.664-6.967 56.788-19.618l3.574-2.804h114.976a7.5 7.5 0 1 0-.001-15z" fill="currentColor" opacity="1" data-original="currentColor" class=""></path>
                    <path d="M192.215 150.164c0 15.372 12.506 27.878 27.878 27.878s27.879-12.506 27.879-27.878-12.507-27.878-27.879-27.878-27.878 12.506-27.878 27.878zm40.757 0c0 7.101-5.777 12.878-12.879 12.878-7.101 0-12.878-5.777-12.878-12.878s5.777-12.878 12.878-12.878c7.101-.001 12.879 5.777 12.879 12.878zM273.049 203.771c-12.599 0-22.848 10.25-22.848 22.848s10.249 22.847 22.848 22.847 22.848-10.249 22.848-22.847-10.25-22.848-22.848-22.848zm0 30.695c-4.327 0-7.848-3.52-7.848-7.847s3.521-7.848 7.848-7.848 7.848 3.521 7.848 7.848-3.521 7.847-7.848 7.847zM474.178 493.298h-9.202l-73.199-62.323c-3.155-2.686-7.888-2.305-10.573.849s-2.305 7.887.849 10.572l59.785 50.902H43.105l108.164-92.092a77.855 77.855 0 0 1 50.423-18.558h81.558a77.851 77.851 0 0 1 50.423 18.558l24.029 20.458a7.498 7.498 0 0 0 10.573-.849 7.5 7.5 0 0 0-.849-10.572l-24.029-20.458a92.867 92.867 0 0 0-60.147-22.137h-51.158v-26.806h15.44c24.205 0 43.896-19.692 43.896-43.897v-8.808c0-6.785-5.52-12.305-12.305-12.305h-18.135c-19.99 0-36.891 13.437-42.174 31.749-5.716-4.945-13.156-7.947-21.29-7.947h-15.061c-6.942 0-12.591 5.648-12.591 12.592v7.399c0 17.97 14.619 32.589 32.589 32.589h14.629v15.433h-15.399a92.867 92.867 0 0 0-60.147 22.137L19.967 493.298H7.5c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h466.678a7.5 7.5 0 0 0 0-15zM232.092 319.73c0-15.934 12.963-28.897 28.897-28.897h15.439v6.112c0 15.934-12.963 28.897-28.896 28.897h-15.44zm-16.978 17.485h-12.651c-9.698 0-17.589-7.89-17.589-17.589v-4.991h12.651c9.698 0 17.589 7.89 17.589 17.589z" fill="currentColor" opacity="1" data-original="currentColor" class=""></path>
                    <path d="M178.358 429.065c0 13.218 10.754 23.972 23.972 23.972s23.972-10.753 23.972-23.972-10.754-23.972-23.972-23.972-23.972 10.753-23.972 23.972zm32.944 0c0 4.947-4.024 8.972-8.972 8.972s-8.972-4.025-8.972-8.972 4.024-8.972 8.972-8.972 8.972 4.024 8.972 8.972zM252.23 445.536c0 15.706 12.777 28.484 28.483 28.484s28.484-12.778 28.484-28.484-12.778-28.484-28.484-28.484-28.483 12.778-28.483 28.484zm41.968 0c0 7.435-6.049 13.484-13.484 13.484s-13.483-6.049-13.483-13.484 6.049-13.484 13.483-13.484c7.435 0 13.484 6.049 13.484 13.484z" fill="currentColor" opacity="1" data-original="currentColor" class=""></path>
                  </g>
                </svg>
              </div>
              <div class="service-item-content">
                <h3 class="service-heading">{{ $item->title }}</h3>
                <span class="badge bg-success mb-2">{{ \Carbon\Carbon::parse($item->date_start)->format('d F Y') }} - {{ \Carbon\Carbon::parse($item->date_end)->format('d F Y') }}</span>
                <!--<p>{{ $item->ket }}</p>-->
              </div>
            </center>
          </div>
        </div>
        @endif
        @endforeach
      </div>
    </div>
    </div>
  </section>
  <!-- /Services Section -->

  @foreach ($data['event'] as $index => $item)
  <!-- About Section -->
  <section id="about{{ sprintf('%02d', $index + 1) }}" class="about section"
    @if ($loop->last) style="padding-bottom: 0" @endif>

    <div class="content" @if ($index % 2==1) style="background-color: #C9A227" @endif>
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <img src="{{ asset('storage/file_ms_semnas/' . $item->foto) }}" alt="Image" class="img-fluid img-overlap" data-aos="zoom-out">
          </div>
          <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">
            <h3 class="content-subtitle text-white opacity-50">Event {{ sprintf('%02d', $index + 1) }}</h3>
            <h2 class="content-title mb-4">
              {{ $item->name }}
            </h2>
            <p class="opacity-50">
              {{ $item->tema }}
            </p>

            <div class="row my-5">
              <div class="col-lg-12 d-flex align-items-start mb-4">
                <i class="bi bi-cash-coin me-4 display-6"></i>
                <div>
                  <h4 class="m-0 h5 text-white">Tanggal </h4>
                  <p class="text-white opacity-50">{{ $item->tanggal }}</p>
                </div>
              </div>
              <!--<div class="col-lg-12 d-flex align-items-start mb-4">-->
              <!--  <i class="bi bi-tags me-4 display-6"></i>-->
              <!--  <div>-->
              <!--    <h4 class="m-0 h5 text-white">Kategori</h4>-->
              <!--    <p class="text-white opacity-50">{{ $item->type_name }}</p>-->
              <!--  </div>-->
              <!--</div>-->
            </div>
            <a class="btn btn-primary" href="{{ url('/events') }}">Learn More</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /About Section -->
  @endforeach
</main>


<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Revisi Data Pemakalah</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(window).on('load', function() {
    $('#editModal').modal('show');
  });
</script>
@endsection