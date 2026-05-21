@extends('layouts.public')
@section('title', 'Hizmetlerimiz — ALEN METAL')

@section('content')
<main class="pt-24 pb-20">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <h1 class="font-display-lg text-display-lg text-primary-container mb-4">Hizmetlerimiz</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant mb-12 max-w-2xl">
            Metal gücümüz ve tecrübemizle, yaşam alanlarınız için güvenli çözümler üretiyoruz.
        </p>
        @if($services->isEmpty())
            <p class="text-on-surface-variant font-body-md text-center py-20">Henüz hizmet eklenmedi.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter max-w-7xl mx-auto">
                @foreach($services as $s)
                    @php $featureList = $s->features ? array_filter(array_map('trim', explode(',', $s->features))) : []; @endphp
                    <div class="glass-panel p-6 rounded-lg hover:-translate-y-1 transition-transform">
                        @if($s->image_url)
                            <div class="w-full h-48 mb-4 rounded-lg overflow-hidden">
                                <img src="{{ $s->image_url }}" alt="{{ $s->title }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <span class="material-symbols-outlined text-4xl text-primary-container mb-4">{{ $s->icon }}</span>
                        @endif
                        <h3 class="font-headline-lg text-headline-lg text-on-surface mb-3">{{ $s->title }}</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mb-4">{{ $s->description }}</p>
                        @if(!empty($featureList))
                            <ul class="space-y-2">
                                @foreach($featureList as $f)
                                <li class="flex items-center gap-2 font-label-bold text-label-bold text-on-surface-variant">
                                    <span class="material-symbols-outlined text-sm text-primary-container">check</span>
                                    {{ $f }}
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</main>
@endsection
