<aside class="w-64 min-h-screen bg-surface-container-low border-r border-outline-variant/30 p-4 flex flex-col">
    <a href="/admin" class="flex items-center gap-3 mb-8 hover:opacity-90 transition-opacity">
        <img src="{{ asset('images/logo.png') }}?v=5" alt="ALEN METAL" style="height: 80px; width: auto; object-fit: contain;">
        <span class="font-headline-lg text-headline-lg text-primary-container">ALEN METAL</span>
    </a>
    <nav class="flex flex-col gap-1 flex-1">
        @php
        $links = [
            ['url' => '/admin', 'label' => 'Dashboard', 'icon' => 'dashboard'],
            ['url' => '/admin/hizmetler', 'label' => 'Hizmetler', 'icon' => 'construction'],
            ['url' => '/admin/projeler', 'label' => 'Projeler', 'icon' => 'photo_library'],
            ['url' => '/admin/istatistikler', 'label' => 'İstatistikler', 'icon' => 'bar_chart'],
            ['url' => '/admin/mesajlar', 'label' => 'Mesajlar', 'icon' => 'mail'],
            ['url' => '/admin/medya', 'label' => 'Medya', 'icon' => 'perm_media'],
            ['url' => '/admin/kullanicilar', 'label' => 'Kullanıcılar', 'icon' => 'people'],
            ['url' => '/admin/ayarlar', 'label' => 'Ayarlar', 'icon' => 'settings'],
        ];
        @endphp
        @foreach($links as $link)
            @php
                $isActive = request()->is(trim($link['url'], '/')) ||
                    ($link['url'] !== '/admin' && request()->is(trim($link['url'], '/') . '*'));
            @endphp
            <a href="{{ $link['url'] }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded text-body-md font-body-md transition-colors {{ $isActive ? 'bg-primary-container/15 text-primary-container' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high' }}">
                <span class="material-symbols-outlined text-xl">{{ $link['icon'] }}</span>
                {{ $link['label'] }}
            </a>
        @endforeach
    </nav>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded text-on-surface-variant hover:text-error hover:bg-surface-container-high transition-colors font-label-bold text-label-bold">
            <span class="material-symbols-outlined text-xl">logout</span>
            Çıkış Yap
        </button>
    </form>
</aside>
