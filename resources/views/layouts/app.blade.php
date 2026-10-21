<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LaporBanjir')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        /* ── Navbar ── */
        nav {
            background-color: #1a1a2e;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }
        nav .brand {
            color: #e94560;
            font-size: 1.3rem;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 1px;
        }
        nav ul { list-style: none; display: flex; gap: 1.5rem; }
        nav ul li a {
            color: #ccc;
            text-decoration: none;
            font-size: 0.95rem;
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            transition: background 0.2s, color 0.2s;
        }
        nav ul li a:hover,
        nav ul li a.active { background-color: #e94560; color: #fff; }

        /* ── Container ── */
        .container {
            max-width: 900px;
            margin: 2.5rem auto;
            padding: 0 1.5rem;
        }
        .container-laporan {
            max-width: 900px;
            margin: 2.5rem auto;
            padding: 0 1.5rem;
        }
        .laporan-grid { display: flex; flex-direction: column; gap: 0; }
        .laporan-empty {
            text-align: center;
            padding: 3rem;
            color: #aaa;
            font-size: 1rem;
        }

        /* ── Card ── */
        .card {
            background: #fff;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }
        .card-header {
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e94560;
        }
        .card-header--success { border-bottom-color: #28a745; }
        .card-title {
            font-size: 1.6rem;
            color: #1a1a2e;
            margin-bottom: 0.3rem;
        }
        .card-subtitle {
            font-size: 0.95rem;
            color: #e94560;
            font-weight: 600;
            margin-bottom: 0.3rem;
        }
        .card-desc { font-size: 0.9rem; color: #666; }
        .card-body { margin-top: 0; }
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 1rem;
        }

        /* ── Data list (konfirmasi) ── */
        .data-list { display: flex; flex-direction: column; gap: 0; margin-bottom: 1.5rem; }
        .data-row {
            display: flex;
            padding: 0.7rem 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .data-label {
            width: 180px;
            font-weight: 600;
            color: #666;
            font-size: 0.9rem;
            flex-shrink: 0;
        }
        .data-value { color: #333; font-size: 0.95rem; }

        /* ── Form ── */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            margin-bottom: 1.3rem;
        }
        .form-group.has-error .form-input { border-color: #e94560; }
        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #444;
        }
        .required-mark { color: #e94560; }
        .form-input {
            padding: 0.55rem 0.85rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.2s;
            width: 100%;
        }
        .form-input:focus { border-color: #e94560; }
        .form-error {
            color: #e94560;
            font-size: 0.85rem;
        }
        .form-hint { font-size: 0.82rem; color: #888; }
        .form-actions { margin-top: 1.5rem; display: flex; gap: 0.8rem; }

        /* ── Input dengan satuan ── */
        .input-with-unit {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .input-with-unit .form-input { width: 140px; }
        .unit-label { font-size: 0.9rem; color: #666; }

        /* ── Buttons ── */
        .btn {
            display: inline-block;
            padding: 0.55rem 1.3rem;
            border: none;
            border-radius: 6px;
            font-size: 0.95rem;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-primary { background-color: #e94560; color: #fff; }
        .btn-primary:hover { background-color: #c73652; }
        .btn-secondary { background-color: #1a1a2e; color: #fff; }
        .btn-secondary:hover { background-color: #2e2e50; }

        /* ── Bahaya badge ── */
        .bahaya-badge {
            display: inline-block;
            padding: 0.25rem 0.8rem;
            border-radius: 20px;
            font-size: 0.82rem;
            font-weight: 600;
            color: #fff;
        }
        .bahaya-waspada { background-color: #f0ad4e; color: #333; }
        .bahaya-siaga   { background-color: #d9534f; }
        .bahaya-awas    { background-color: #7b0000; }
        .bahaya-hidden  { display: none; }

        /* ── Alert ── */
        .alert {
            padding: 0.9rem 1.2rem;
            border-radius: 8px;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger  { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .alert-info    { background-color: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }

        /* ── Misc ── */
        .text-muted { color: #aaa; }
        .badge {
            display: inline-block;
            background-color: #e94560;
            color: #fff;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.82rem;
        }
    </style>
</head>
<body>

    <x-navbar />

    <div class="container">
        @yield('content')
    </div>

</body>
</html>