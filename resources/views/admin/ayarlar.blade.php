@extends('layouts.admin')
@section('title', 'Ayarlar')

@section('content')
<div x-data="ayarlar()" x-init="fetchData()">
    <h1 class="font-headline-xl text-headline-xl text-primary-container mb-8">Ayarlar</h1>

    <div class="glass-panel p-6 rounded-lg space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Tagline</label>
                <input x-model="form.tagline" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Hero Açıklama</label>
                <textarea x-model="form.hero_description" rows="2" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none resize-none"></textarea>
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Hero Görsel URL</label>
                <input x-model="form.hero_image_url" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">İletişim Kişi 1</label>
                <input x-model="form.contact_name_1" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Telefon 1</label>
                <input x-model="form.phone_1" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">İletişim Kişi 2</label>
                <input x-model="form.contact_name_2" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Telefon 2</label>
                <input x-model="form.phone_2" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Footer Açıklama</label>
                <input x-model="form.footer_description" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Hakkımızda Giriş</label>
                <textarea x-model="form.about_intro" rows="2" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none resize-none"></textarea>
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Misyon</label>
                <textarea x-model="form.mission_text" rows="2" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none resize-none"></textarea>
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Vizyon</label>
                <textarea x-model="form.vision_text" rows="2" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none resize-none"></textarea>
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Adres</label>
                <input x-model="form.address" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Harita Sorgusu</label>
                <input x-model="form.map_query" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Copyright</label>
                <input x-model="form.copyright" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
            </div>
        </div>
        <div>
            <button @click="save" :disabled="saving"
                class="bg-primary-container text-on-primary-container font-label-bold text-label-bold px-8 py-3 rounded hover:bg-primary-container/90 transition-all shadow-lg shadow-black/20 glow-hover disabled:opacity-50">
                <span x-text="saving ? 'Kaydediliyor...' : 'Kaydet'"></span>
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function ayarlar() {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const endpoint = '/admin/api/site-config';
    return {
        form: {}, saving: false,
        async fetchData() { this.form = await fetch(endpoint, { headers: { 'Accept': 'application/json' } }).then(r => r.json()); },
        async save() {
            this.saving = true;
            await fetch(endpoint, { method: 'PUT', headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf }, body: JSON.stringify(this.form) });
            this.saving = false;
        },
    };
}
</script>
@endpush
