@extends('fe-layouts.master')

@section('content')
<main class="main">

    <!-- Invoice Section -->
    <section id="invoice-section" class="invoice-section section">
        <div class="container">
            <div class="invoice-box">
                <h1>Download File</h1>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama File</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="align-middle">
                                <td style="text-align: center;">1</td>
                                <td>Template Jurnal UMIBA 2024</td>
                                <td>
                                    <a href="{{ asset('file/Template Jurnal UMIBA 2024.docx') }}" class="btn btn-warning" download>
                                        Download File
                                    </a>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <td style="text-align: center;">2</td>
                                <td>Template artikel penelitian dengan WATERMARK</td>
                                <td>
                                    <a href="{{ asset('file/Template artikel penelitian dengan WATERMARK.docx') }}" class="btn btn-warning" download>
                                        Download File
                                    </a>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <td style="text-align: center;">3</td>
                                <td>Template artikel pengabdian dengan WATERMARK</td>
                                <td>
                                    <a href="{{ asset('file/Template artikel pengabdian dengan WATERMARK.docx') }}" class="btn btn-warning" download>
                                        Download File
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection