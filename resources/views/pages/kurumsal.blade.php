@extends('layouts.public')
@section('title', 'Kurumsal — ALEN METAL')

@section('content')
<main class="pt-24 pb-20">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <h1 class="font-display-lg text-display-lg text-primary-container mb-4">Kurumsal</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant mb-12 max-w-2xl">
            {{ $config['about_intro'] ?? 'ALEN METAL olarak, metal sektöründe yılların getirdiği tecrübe ile güvenlik ve dayanıklılıkta kalite standardını belirliyoruz.' }}
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter mb-20">
            <div class="glass-panel p-6 rounded-lg">
                <span class="material-symbols-outlined text-4xl text-primary-container mb-4">visibility</span>
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-3">Misyonumuz</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    {{ $config['mission_text'] ?? "Müşterilerimize en kaliteli metal ürünlerini ve güvenlik çözümlerini sunarak, yaşam alanlarını daha güvenli ve estetik hale getirmek. Teknoloji ve işçiliği birleştirerek sektörde öncü olmak." }}
                </p>
            </div>
            <div class="glass-panel p-6 rounded-lg">
                <span class="material-symbols-outlined text-4xl text-primary-container mb-4">flag</span>
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-3">Vizyonumuz</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    {{ $config['vision_text'] ?? "Türkiye'nin lider metal ve güvenlik sistemleri markası olarak, uluslararası standartlarda üretim yapmak ve global pazarda söz sahibi olmak. Sürdürülebilir büyüme ile sektöre yön vermek." }}
                </p>
            </div>
        </div>

        <h2 class="font-headline-xl text-headline-xl text-primary-container mb-8 text-center">Neden Biz?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter mb-20">
            @php
            $reasons = [
                ['icon' => 'handshake', 'title' => 'Güvenilir Hizmet', 'desc' => 'Yılların verdiği tecrübe ve müşteri memnuniyeti odaklı çalışma prensibimizle güvenilir hizmet sunuyoruz.'],
                ['icon' => 'star', 'title' => 'Kaliteli Malzeme', 'desc' => 'En kaliteli hammadde ve modern üretim teknikleri ile uzun ömürlü ürünler üretiyoruz.'],
                ['icon' => 'bolt', 'title' => 'Hızlı Teslimat', 'desc' => 'Profesyonel ekibimiz ve organize çalışma sistemimizle projelerinizi zamanında teslim ediyoruz.'],
            ];
            @endphp
            @foreach($reasons as $item)
            <div class="glass-panel p-6 rounded-lg text-center">
                <span class="material-symbols-outlined text-4xl text-primary-container mb-4">{{ $item['icon'] }}</span>
                <h3 class="font-headline-lg text-headline-lg text-on-surface mb-3">{{ $item['title'] }}</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
