<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LaporBanjir') — BPBD Kab. Bandung</title>

    <link rel="stylesheet" href="{{ asset('css/laporbanjir.css') }}">
</head>
<body>

    <div class="page-wrapper">
        @yield('content')
    </div>

    <script src="{{ asset('js/laporbanjir.js') }}"></script>
</body>
</html>

