<footer class="w-full py-16 px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row justify-between items-start gap-gutter bg-surface-container-lowest border-t border-outline-variant/20">
    <div class="flex flex-col gap-4 max-w-sm">
        <div class="flex items-center gap-4">
            <img src="{{ asset('images/logo.png') }}?v=5" alt="ALEN METAL" style="height: 112px; width: auto; object-fit: contain;">
            <span class="font-headline-lg text-headline-lg font-bold text-primary-container">
                ALEN METAL
            </span>
        </div>
        <p class="font-body-md text-body-md text-on-surface-variant">
            {{ $config['footer_description'] ?? 'Güçlü Yapılar, Güvenli Yarınlar.' }}
        </p>
        <p class="font-label-bold text-label-bold text-primary-container mt-4">
            {{ $config['copyright'] ?? '© 2024 Alen Metal. Güçlü Yapılar, Güvenli Yarınlar.' }}
        </p>
    </div>
    <div class="flex flex-col gap-4">
        <h4 class="font-headline-lg text-headline-lg text-on-surface text-xl">Hızlı Linkler</h4>
        <a href="/hizmetler" class="font-body-md text-body-md text-on-surface-variant hover:text-primary-container hover:translate-x-1 transition-all duration-200">Hizmetlerimiz</a>
        <a href="/kurumsal" class="font-body-md text-body-md text-on-surface-variant hover:text-primary-container hover:translate-x-1 transition-all duration-200">Kurumsal</a>
        <a href="/galeri" class="font-body-md text-body-md text-on-surface-variant hover:text-primary-container hover:translate-x-1 transition-all duration-200">Galeri</a>
        <a href="/#iletisim" class="font-body-md text-body-md text-on-surface-variant hover:text-primary-container hover:translate-x-1 transition-all duration-200">İletişim</a>
    </div>
    <div class="flex flex-col gap-4">
        <h4 class="font-headline-lg text-headline-lg text-on-surface text-xl">Yasal</h4>
        <a href="/gizlilik-politikasi" class="font-body-md text-body-md text-on-surface-variant hover:text-primary-container hover:translate-x-1 transition-all duration-200">Gizlilik Politikası</a>
        <a href="/kullanim-kosullari" class="font-body-md text-body-md text-on-surface-variant hover:text-primary-container hover:translate-x-1 transition-all duration-200">Kullanım Koşulları</a>
    </div>
</footer>
