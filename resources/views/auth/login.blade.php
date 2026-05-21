<!DOCTYPE html>
<html lang="tr" class="dark h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Girişi — ALEN METAL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-background flex items-center justify-center font-body-md text-body-md">
    <div class="w-full max-w-md p-8">
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}?v=5" alt="ALEN METAL" style="height: 180px; width: auto; object-fit: contain; margin: 0 auto;">
            <h1 class="font-headline-xl text-headline-xl text-primary-container mt-4">ALEN METAL</h1>
            <p class="text-on-surface-variant mt-2">Yönetim Paneli</p>
        </div>

        <div class="glass-panel p-8 rounded-lg">
            @if($errors->any())
                <div class="bg-error-container/20 border border-error text-on-error-container font-label-bold text-label-bold px-4 py-3 rounded mb-6">
                    Geçersiz e-posta veya şifre.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" x-data="{ loading: false }" @submit="loading = true">
                @csrf

                <div class="mb-4">
                    <label for="email" class="font-label-bold text-label-bold text-on-surface block mb-2">E-posta</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="w-full bg-surface-container border border-outline-variant rounded px-4 py-3 text-on-surface font-body-md focus:border-primary-container focus:outline-none transition-colors">
                </div>

                <div class="mb-6">
                    <label for="password" class="font-label-bold text-label-bold text-on-surface block mb-2">Şifre</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full bg-surface-container border border-outline-variant rounded px-4 py-3 text-on-surface font-body-md focus:border-primary-container focus:outline-none transition-colors">
                </div>

                <button type="submit" :disabled="loading"
                    class="w-full bg-primary-container text-on-primary-container font-label-bold text-label-bold px-8 py-4 rounded hover:bg-primary-container/90 transition-all shadow-lg shadow-black/20 glow-hover disabled:opacity-50 flex items-center justify-center gap-2">
                    <span x-show="!loading">Giriş Yap</span>
                    <span x-show="loading" class="flex items-center gap-2">
                        <span class="material-symbols-outlined animate-spin text-lg">progress_activity</span>
                        Giriş yapılıyor...
                    </span>
                </button>
            </form>
        </div>
    </div>
</body>
</html>
