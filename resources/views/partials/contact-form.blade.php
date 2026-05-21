<section id="iletisim" class="py-20 bg-surface-container-low">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <h2 class="font-display-lg text-display-lg text-primary-container mb-4">İletişim</h2>
        <p class="font-body-lg text-body-lg text-on-surface-variant mb-12 max-w-2xl">
            Bizimle iletişime geçin. Projeleriniz için ücretsiz keşif ve fiyat teklifi alın.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
            <div x-data="contactForm()">
                <template x-if="submitted">
                    <div class="glass-panel p-6 rounded-lg text-center py-12">
                        <span class="material-symbols-outlined text-5xl text-primary-container mb-4">check_circle</span>
                        <h3 class="font-headline-lg text-headline-lg text-on-surface mb-2">Mesajınız Gönderildi!</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mb-6">
                            En kısa sürede size dönüş yapacağız.
                        </p>
                        <button @click="submitted = false" class="bg-primary-container text-on-primary-container font-label-bold text-label-bold px-6 py-2 rounded hover:bg-primary-container/90 transition-colors">
                            Yeni Mesaj Gönder
                        </button>
                    </div>
                </template>
                <template x-if="!submitted">
                    <form class="space-y-6" @submit.prevent="submitForm">
                        <div>
                            <label class="font-label-bold text-label-bold text-on-surface block mb-2">Ad Soyad</label>
                            <input type="text" required x-model="form.name" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-3 text-on-surface font-body-md focus:border-primary-container focus:outline-none transition-colors" placeholder="Adınız ve soyadınız">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="font-label-bold text-label-bold text-on-surface block mb-2">E-posta</label>
                                <input type="email" x-model="form.email" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-3 text-on-surface font-body-md focus:border-primary-container focus:outline-none transition-colors" placeholder="ornek@mail.com">
                            </div>
                            <div>
                                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Telefon</label>
                                <input type="tel" required x-model="form.phone" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-3 text-on-surface font-body-md focus:border-primary-container focus:outline-none transition-colors" placeholder="05XX XXX XX XX">
                            </div>
                        </div>
                        <div>
                            <label class="font-label-bold text-label-bold text-on-surface block mb-2">Mesajınız</label>
                            <textarea rows="5" required x-model="form.message" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-3 text-on-surface font-body-md focus:border-primary-container focus:outline-none transition-colors resize-none" placeholder="Projeniz hakkında bilgi verin..."></textarea>
                        </div>
                        <button type="submit" :disabled="loading" class="bg-primary-container text-on-primary-container font-label-bold text-label-bold px-8 py-4 rounded hover:bg-primary-container/90 transition-all shadow-lg shadow-black/20 glow-hover disabled:opacity-50">
                            <span x-text="loading ? 'Gönderiliyor...' : 'Gönder'"></span>
                        </button>
                    </form>
                </template>
            </div>
            <div class="space-y-6">
                @if(!empty($config['contact_name_1']) && !empty($config['phone_1']))
                <div class="glass-panel p-6 rounded-lg">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-2xl text-primary-container">person</span>
                        <div>
                            <div class="font-label-bold text-label-bold text-on-surface">{{ $config['contact_name_1'] }}</div>
                            <a href="tel:{{ preg_replace('/\s/', '', $config['phone_1']) }}" class="font-body-md text-body-md text-primary-container hover:underline">{{ $config['phone_1'] }}</a>
                        </div>
                    </div>
                </div>
                @endif
                @if(!empty($config['contact_name_2']) && !empty($config['phone_2']))
                <div class="glass-panel p-6 rounded-lg">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-2xl text-primary-container">person</span>
                        <div>
                            <div class="font-label-bold text-label-bold text-on-surface">{{ $config['contact_name_2'] }}</div>
                            <a href="tel:{{ preg_replace('/\s/', '', $config['phone_2']) }}" class="font-body-md text-body-md text-primary-container hover:underline">{{ $config['phone_2'] }}</a>
                        </div>
                    </div>
                </div>
                @endif
                @if(!empty($config['address']))
                <div class="glass-panel p-6 rounded-lg">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="material-symbols-outlined text-2xl text-primary-container">location_on</span>
                        <div>
                            <div class="font-label-bold text-label-bold text-on-surface">Adres</div>
                            <div class="font-body-md text-body-md text-on-surface-variant">{{ $config['address'] }}</div>
                        </div>
                    </div>
                    <div class="rounded-lg overflow-hidden border border-outline-variant/30 h-64">
                        @php
                            $mapQuery = $config['map_query'] ?? $config['address'] ?? 'İstanbul, Türkiye';
                        @endphp
                        <iframe src="https://www.google.com/maps?q={{ urlencode($mapQuery) }}&output=embed&z=14" width="100%" height="100%" style="border: 0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="ALEN METAL Konum"></iframe>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function contactForm() {
        return {
            form: { name: '', email: '', phone: '', message: '' },
            submitted: false,
            loading: false,
            async submitForm() {
                this.loading = true;
                await fetch('/iletisim', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify(this.form),
                });
                this.loading = false;
                this.submitted = true;
                this.form = { name: '', email: '', phone: '', message: '' };
            }
        };
    }
</script>
@endpush
