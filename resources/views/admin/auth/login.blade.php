<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - {{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-body login-body">

    <div class="login">
        <div class="login__card">
            <div class="login__brand">
                <span class="login__logo"><x-svg-icon name="gear"/></span>
                <h2 class="login__title">{{ config('app.name') }}</h2>
                <p class="login__subtitle">Admin Panel</p>
            </div>

            @if (session('error'))
                <div class="alert alert--error" role="alert">
                    <x-svg-icon name="close" class="alert__icon"/>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.attempt') }}" novalidate>
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" required autofocus autocomplete="email">
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="margin-top: 14px;">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           required autocomplete="current-password">
                    @error('password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <label class="form-check" style="margin-top: 14px;">
                    <input type="checkbox" name="remember" value="1">
                    <span>Ingat saya</span>
                </label>

                <button type="submit" class="btn btn--primary btn--block btn--lg mt-2">Masuk</button>
            </form>

            <p class="login__footer">
                <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">
                    &larr; Kembali ke website
                </a>
            </p>
        </div>
    </div>

</body>
</html>