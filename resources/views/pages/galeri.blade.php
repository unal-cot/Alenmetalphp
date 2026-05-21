@extends('layouts.public')
@section('title', 'Galeri — ALEN METAL')

@push('head')
<script>
    window.galleryData = @json($projects);
</script>
@endpush

@section('content')
<main class="pt-24 pb-20" x-data="galleryLightbox()">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <h1 class="font-display-lg text-display-lg text-primary-container mb-4">Galeri</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant mb-12 max-w-2xl">
            Tamamladığımız projelerden örnekler ve ürünlerimizin detaylı görselleri.
        </p>
        @if($projects->isEmpty())
            <p class="text-on-surface-variant font-body-md text-center py-20">
                Henüz proje eklenmedi. Admin panelinden galeriye proje ekleyebilirsiniz.
            </p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
                @foreach($projects as $item)
                    @php
                        $imgs = $item->images->pluck('url')->toArray();
                        if (empty($imgs) && $item->image_url) $imgs = [$item->image_url];
                        $coverImg = $imgs[0] ?? '';
                    @endphp
                    <div class="glass-panel rounded-lg overflow-hidden group hover:-translate-y-1 transition-transform">
                        <div class="aspect-[4/3] overflow-hidden cursor-pointer relative" @click="open({{ $item->id }}, 0)">
                            <img alt="{{ $item->title }}" src="{{ $coverImg }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @if(count($imgs) > 1)
                                <span class="absolute top-2 right-2 bg-black/60 text-white text-xs font-label-bold px-2 py-1 rounded">
                                    +{{ count($imgs) - 1 }}
                                </span>
                            @endif
                        </div>
                        <div class="p-4">
                            <span class="font-label-bold text-label-bold text-primary-container">{{ $item->category }}</span>
                            <h3 class="font-headline-lg text-headline-lg text-on-surface mt-1">{{ $item->title }}</h3>
                            @if($item->description)
                                <p class="font-body-md text-body-md text-on-surface-variant mt-2 line-clamp-2">{{ $item->description }}</p>
                            @endif
                            @if(count($imgs) > 1)
                                <div class="flex gap-2 mt-3">
                                    @foreach($imgs as $i => $url)
                                        <img src="{{ $url }}" alt="" class="w-10 h-10 rounded object-cover cursor-pointer border border-outline-variant/30 hover:border-primary-container transition-colors" @click.stop="open({{ $item->id }}, {{ $i }})">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Lightbox -->
    <div x-show="active" @click.self="close()" class="fixed inset-0 z-[300] bg-black/90 backdrop-blur-sm flex items-center justify-center p-4" x-cloak>
        <button @click="close()" class="absolute top-4 right-4 text-white hover:text-primary-container transition-colors z-10">
            <span class="material-symbols-outlined text-4xl">close</span>
        </button>

        <template x-if="images.length > 1">
            <div>
                <button @click.stop="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 text-white hover:text-primary-container transition-colors z-10 bg-black/30 rounded-full p-2">
                    <span class="material-symbols-outlined text-4xl">chevron_left</span>
                </button>
                <button @click.stop="next()" class="absolute right-4 top-1/2 -translate-y-1/2 text-white hover:text-primary-container transition-colors z-10 bg-black/30 rounded-full p-2">
                    <span class="material-symbols-outlined text-4xl">chevron_right</span>
                </button>
            </div>
        </template>

        <div class="max-w-5xl max-h-[90vh] w-full flex flex-col items-center" @click.stop>
            <img :src="currentUrl()" :alt="title" class="w-full h-auto max-h-[78vh] object-contain rounded-lg">
            <div class="text-center mt-4">
                <span class="font-label-bold text-label-bold text-primary-container" x-text="category"></span>
                <h3 class="font-headline-lg text-headline-lg text-on-surface mt-1" x-text="title"></h3>
                <p class="font-body-md text-body-md text-on-surface-variant mt-1" x-show="images.length > 1">
                    <span x-text="imageIndex + 1"></span> / <span x-text="images.length"></span>
                </p>
            </div>
            <div class="flex gap-2 mt-3" x-show="images.length > 1">
                <template x-for="(url, i) in images" :key="i">
                    <img :src="url" alt="" class="w-12 h-12 rounded object-cover cursor-pointer border-2 transition-colors"
                        :class="i === imageIndex ? 'border-primary-container' : 'border-transparent hover:border-outline-variant'"
                        @click.stop="imageIndex = i">
                </template>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    function galleryLightbox() {
        return {
            active: false,
            projectId: null,
            imageIndex: 0,
            title: '',
            category: '',
            images: [],
            open(projectId, index) {
                const projects = window.galleryData;
                const p = projects.find(pr => pr.id == projectId);
                if (!p) return;
                let imgs = p.images?.map(i => i.url) || [];
                if (imgs.length === 0 && p.image_url) imgs = [p.image_url];
                this.images = imgs;
                this.projectId = projectId;
                this.imageIndex = index;
                this.title = p.title;
                this.category = p.category;
                this.active = true;
            },
            close() { this.active = false; },
            currentUrl() { return this.images[this.imageIndex] || ''; },
            next() { this.imageIndex = (this.imageIndex + 1) % this.images.length; },
            prev() { this.imageIndex = (this.imageIndex - 1 + this.images.length) % this.images.length; },
        };
    }
</script>
@endpush
