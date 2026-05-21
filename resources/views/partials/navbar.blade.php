<nav x-data="{ mobileOpen: false }" @resize.window="if (window.innerWidth >= 768) mobileOpen = false">
    <!-- Desktop Nav -->
    <div class="fixed top-0 left-0 w-full z-[100] hidden md:flex justify-between items-center px-margin-desktop h-24 bg-secondary-container/70 backdrop-blur-md border-b border-outline-variant/30 shadow-md">
        <a href="/" class="flex items-center gap-4 hover:opacity-90 transition-opacity">
            <img src="{{ asset('images/logo.png') }}?v=5" alt="ALEN METAL" style="height: 88px; width: auto; object-fit: contain;">
            <span class="font-headline-xl text-headline-xl font-bold tracking-tighter text-primary-container">
                ALEN METAL
            </span>
        </a>
        <div class="flex items-center gap-gutter">
            <a href="/" class="font-label-bold text-label-bold pb-1 transition-colors {{ request()->is('/') ? 'text-primary-container border-b-2 border-primary-container' : 'text-on-surface hover:text-primary-container' }}">Ana Sayfa</a>
            <a href="/hizmetler" class="font-label-bold text-label-bold pb-1 transition-colors {{ request()->is('hizmetler') ? 'text-primary-container border-b-2 border-primary-container' : 'text-on-surface hover:text-primary-container' }}">Hizmetlerimiz</a>
            <a href="/kurumsal" class="font-label-bold text-label-bold pb-1 transition-colors {{ request()->is('kurumsal') ? 'text-primary-container border-b-2 border-primary-container' : 'text-on-surface hover:text-primary-container' }}">Kurumsal</a>
            <a href="/galeri" class="font-label-bold text-label-bold pb-1 transition-colors {{ request()->is('galeri') ? 'text-primary-container border-b-2 border-primary-container' : 'text-on-surface hover:text-primary-container' }}">Galeri</a>
        </div>
        <div>
            <a href="/#iletisim" class="bg-primary-container text-on-primary-container font-label-bold text-label-bold px-6 py-3 rounded hover:bg-primary-container/90 transition-colors shadow-lg shadow-black/20 glow-hover">
                Teklif Al
            </a>
        </div>
    </div>

    <!-- Mobile Nav -->
    <div class="fixed top-0 left-0 w-full z-[100] flex md:hidden justify-between items-center px-margin-mobile h-20 bg-secondary-container/70 backdrop-blur-md border-b border-outline-variant/30">
        <a href="/" class="flex items-center gap-3 hover:opacity-90 transition-opacity">
            <img src="{{ asset('images/logo.png') }}?v=5" alt="ALEN METAL" style="height: 56px; width: auto; object-fit: contain;">
            <span class="font-headline-lg-mobile text-headline-lg-mobile font-bold tracking-tighter text-primary-container">
                ALEN METAL
            </span>
        </a>
        <button @click="mobileOpen = true" class="text-primary-container">
            <span class="material-symbols-outlined text-3xl">menu</span>
        </button>
    </div>

    <!-- Mobile Drawer -->
    <div x-show="mobileOpen" x-cloak class="fixed inset-0 z-[200] md:hidden" @click.self="mobileOpen = false">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="mobileOpen = false"></div>
        <div class="absolute right-0 top-0 h-full w-72 bg-secondary-container border-l border-outline-variant/30 shadow-2xl flex flex-col p-6" style="animation: slideIn 0.2s ease-out;">
            <div class="flex justify-between items-center mb-8">
                <span class="font-headline-lg text-headline-lg text-primary-container font-bold">Menü</span>
                <button @click="mobileOpen = false" class="text-on-surface-variant hover:text-primary-container transition-colors">
                    <span class="material-symbols-outlined text-3xl">close</span>
                </button>
            </div>
            <div class="flex flex-col gap-1 flex-1">
                <a href="/" class="font-label-bold text-label-bold px-4 py-3 rounded transition-colors {{ request()->is('/') ? 'bg-primary-container/15 text-primary-container' : 'text-on-surface hover:bg-surface-container-high hover:text-primary-container' }}" @click="mobileOpen = false">Ana Sayfa</a>
                <a href="/hizmetler" class="font-label-bold text-label-bold px-4 py-3 rounded transition-colors {{ request()->is('hizmetler') ? 'bg-primary-container/15 text-primary-container' : 'text-on-surface hover:bg-surface-container-high hover:text-primary-container' }}" @click="mobileOpen = false">Hizmetlerimiz</a>
                <a href="/kurumsal" class="font-label-bold text-label-bold px-4 py-3 rounded transition-colors {{ request()->is('kurumsal') ? 'bg-primary-container/15 text-primary-container' : 'text-on-surface hover:bg-surface-container-high hover:text-primary-container' }}" @click="mobileOpen = false">Kurumsal</a>
                <a href="/galeri" class="font-label-bold text-label-bold px-4 py-3 rounded transition-colors {{ request()->is('galeri') ? 'bg-primary-container/15 text-primary-container' : 'text-on-surface hover:bg-surface-container-high hover:text-primary-container' }}" @click="mobileOpen = false">Galeri</a>
            </div>
            <a href="/#iletisim" @click="mobileOpen = false" class="bg-primary-container text-on-primary-container font-label-bold text-label-bold px-6 py-4 rounded hover:bg-primary-container/90 transition-all shadow-lg shadow-black/20 text-center mt-4">
                Teklif Al
            </a>
        </div>
    </div>
</nav>
