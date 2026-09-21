@php
    $title = $title ?? 'Terjadi Kesalahan';
    $code = $code ?? 500;
    $message = $message ?? (isset($exception) && $exception->getMessage() ? $exception->getMessage() : 'Terjadi kesalahan pada server.');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $code }} - {{ $title }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: radial-gradient(500px 300px at 80% -10%, rgba(245,158,11,.25), transparent),
                        radial-gradient(500px 300px at 0% 110%, rgba(245,158,11,.12), transparent),
                        #0f172a;
            color: #e2e8f0;
            padding: 24px;
            text-align: center;
        }
        .card { max-width: 520px; width: 100%; }
        .code { font-size: clamp(72px, 16vw, 140px); font-weight: 800; line-height: 1; color: #f59e0b; }
        .title { font-size: clamp(20px, 4vw, 28px); font-weight: 700; margin: 12px 0 10px; color: #fff; }
        .message { color: #94a3b8; font-size: 15px; line-height: 1.6; margin-bottom: 30px; }
        .btn {
            display: inline-block;
            background: #f59e0b;
            color: #0f172a;
            padding: 13px 26px;
            border-radius: 10px;
            font-weight: 700;
            text-decoration: none;
            font-size: 15px;
            transition: background-color .15s ease;
        }
        .btn:hover { background: #d97706; }
        .brand { display: inline-flex; align-items: center; gap: 8px; margin-bottom: 34px; font-weight: 800; color: #fff; font-size: 17px; }
        .brand svg { width: 24px; height: 24px; color: #f59e0b; }
    </style>
</head>
<body>
    <div class="card">
        <span class="brand">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/></svg>
            Spare Part Store
        </span>
        <div class="code">{{ $code }}</div>
        <h1 class="title">{{ $title }}</h1>
        <p class="message">{{ $message }}</p>
        <a href="{{ url('/') }}" class="btn">Kembali ke Beranda</a>
    </div>
</body>
</html>