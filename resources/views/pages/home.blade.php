@extends('layouts.public')
@section('title', 'ALEN METAL — ' . ($config['tagline'] ?? 'Güvenlikte Kalite, İşte Güç!'))

@php
    $heroImage = $config['hero_image_url'] ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuA353CKxl5bI0gk8uvabHaHTch4K72ByMLEZtAsIsooGwaJlqIdn0iAugUYqzeu1s9Y1CgQd86iEsk2o7OMgSVuI02EbbQHe-JKzwvBRrYPWffROa7a05dTNn1jX_b6djUWun45oYYy2HCLUMkF7hWgimsbYP9nSVr-9S5l6JsUCRts9RxuM_1-QAgJGtjYlwnNf1N0yTxGN0P7aiRb6ax4NsZphF268zOcUJdGU0YYp43kQahbklMRbzovTem12ZjOxKkJt0DKYSEL';
    $phone = preg_replace('/\s/', '', $config['phone_1'] ?? '05308451754');
@endphp

@section('content')
<!-- Hero -->
<header class="relative h-screen min-h-[800px] flex items-center pt-20">
    <div class="absolute inset-0 z-0">
        <img alt="Hero Background" class="w-full h-full object-cover" src="{{ $heroImage }}">
        <div class="absolute inset-0 hero-overlay"></div>
    </div>
    <div class="relative z-10 w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="max-w-2xl">
            <h1 class="font-display-lg text-display-lg text-primary-container mb-6 drop-shadow-lg">
                {{ $config['tagline'] ?? 'Güvenlikte Kalite, İşte Güç!' }}
            </h1>
            <p class="font-body-lg text-body-lg text-on-surface mb-10 max-w-xl">
                {{ $config['hero_description'] ?? 'Metal gücümüz ve tecrübemizle, yaşam alanlarınız için güvenli çözümler üretiyoruz. Dayanıklılık ve estetiği bir araya getiren premium uygulamalar.' }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="/#iletisim" class="bg-primary-container text-on-primary-container font-label-bold text-label-bold px-8 py-4 rounded hover:bg-primary-container/90 transition-all shadow-lg shadow-black/20 glow-hover w-full sm:w-auto text-center">
                    Teklif Al
                </a>
                <a href="tel:{{ $phone }}" class="bg-transparent border border-primary-container text-primary-container font-label-bold text-label-bold px-8 py-4 rounded hover:bg-primary-container/10 transition-all w-full sm:w-auto text-center flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">call</span>
                    Bizi Ara
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Advantages -->
<section class="py-20 bg-surface">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-gutter">
            @php
            $advantages = [
                ['icon' => 'shield', 'label' => 'Güvenli Çözümler'],
                ['icon' => 'verified', 'label' => 'Kaliteli Malzeme'],
                ['icon' => 'engineering', 'label' => 'Profesyonel Ekip'],
                ['icon' => 'schedule', 'label' => 'Zamanında Teslimat'],
                ['icon' => 'payments', 'label' => 'Uygun Fiyat Garantisi'],
                ['icon' => 'support_agent', 'label' => '7/24 Destek'],
            ];
            @endphp
            @foreach($advantages as $a)
            <div class="glass-panel p-6 rounded-lg flex flex-col items-center text-center hover:-translate-y-1 transition-transform">
                <span class="material-symbols-outlined text-4xl text-primary-container mb-4" style="font-variation-settings: 'FILL' 1;">{{ $a['icon'] }}</span>
                <h3 class="font-label-bold text-label-bold text-on-surface">{{ $a['label'] }}</h3>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="py-20 bg-surface-container-low">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <h2 class="font-headline-xl text-headline-xl text-primary-container mb-12 text-center">HİZMETLERİMİZ</h2>
        @if($services->isEmpty())
            <p class="text-on-surface-variant font-body-md text-center py-12">Henüz hizmet eklenmedi.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
                @foreach($services->take(3) as $s)
                <a href="/hizmetler" class="group relative h-80 rounded-lg overflow-hidden border border-outline-variant/30 cursor-pointer block">
                    @if($s->image_url)
                        <img alt="{{ $s->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="{{ $s->image_url }}">
                    @else
                        <div class="w-full h-full bg-surface-container-high flex items-center justify-center">
                            <span class="material-symbols-outlined text-6xl text-primary-container/30">{{ $s->icon }}</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 card-gradient flex flex-col justify-end p-6">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="material-symbols-outlined text-primary-container">{{ $s->icon }}</span>
                            <h3 class="font-headline-lg text-headline-lg text-on-surface">{{ $s->title }}</h3>
                        </div>
                        <p class="font-body-md text-body-md text-on-surface-variant opacity-0 group-hover:opacity-100 transition-opacity duration-300 h-0 group-hover:h-auto overflow-hidden">
                            {{ $s->description }}
                        </p>
                        <span class="text-primary-container font-label-bold text-label-bold mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center gap-1">
                            Detayları Gör
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Projects Gallery -->
@if($projects->isNotEmpty())
<section class="py-20 px-margin-mobile md:px-margin-desktop">
    <div class="max-w-container-max mx-auto">
        <div class="text-center mb-12">
            <h2 class="font-display-lg text-display-lg text-primary-container mb-4">Projelerimiz</h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto">
                Tamamladığımız projelerden örnekler. Kalite ve güvenin bir arada olduğu çalışmalarımız.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
            @foreach($projects->take(6) as $p)
                @php $coverImg = $p->images->first()?->url ?? $p->image_url; @endphp
                <a href="/galeri" class="group relative rounded-lg overflow-hidden border border-outline-variant/30 cursor-pointer aspect-[4/3]">
                    <img src="{{ $coverImg }}" alt="{{ $p->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @if($p->images->count() > 1)
                        <span class="absolute top-2 right-2 bg-black/60 text-white text-xs font-label-bold px-2 py-1 rounded z-10">
                            +{{ $p->images->count() - 1 }}
                        </span>
                    @endif
                    <div class="absolute inset-0 card-gradient flex flex-col justify-end p-6 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="font-label-bold text-label-bold text-primary-container">{{ $p->category }}</span>
                        <h3 class="font-headline-lg text-headline-lg text-on-surface mt-1">{{ $p->title }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="/galeri" class="inline-flex items-center gap-2 bg-primary-container text-on-primary-container font-label-bold text-label-bold px-8 py-3 rounded hover:bg-primary-container/90 transition-all shadow-lg shadow-black/20 glow-hover">
                Tüm Projeleri Gör
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Contact -->
@include('partials.contact-form')
@endsection
