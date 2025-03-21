<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Pemakalah</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            position: relative;
            font-family: Arial, sans-serif;
        }

        .sertifikat-container {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .sertifikat-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("{{ public_path('storage/file_ms_semnas/' . $dataPemakalah['ms_semnas_file_sertifikat']) }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: -1;
        }

        .nama-container {
            position: absolute;
            top: 28%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 80%;
        }

        .judul-container {
            position: absolute;
            top: 47%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 80%;
        }

        h1 {
            font-size: 40px;
            font-weight: bold;
            margin: 0;
        }

        .judul {
            font-size: 20px;
        }
    </style>
</head>

<body>
    @foreach($writers as $writer)
    <div class="sertifikat-container">
        <div class="sertifikat-bg"></div>
        <div class="nama-container">
            <h1>{{ $writer }}</h1>
        </div>
        <div class="judul-container">
            <p class="judul">{{ $dataPemakalah->title }}</p>
        </div>
    </div>
    @endforeach
</body>

</html>