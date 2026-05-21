@extends('layouts.admin')
@section('title', 'Hizmetler')

@section('content')
<div x-data="hizmetlerCRUD()" x-init="fetchData()">
    <h1 class="font-headline-xl text-headline-xl text-primary-container mb-8">Hizmetler</h1>

    <div class="glass-panel p-6 rounded-lg mb-8 space-y-4">
        <h2 class="font-headline-lg text-headline-lg text-on-surface" x-text="editing ? 'Hizmet Düzenle' : 'Yeni Hizmet Ekle'"></h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Başlık</label>
                <input x-model="form.title" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">İkon</label>
                <select x-model="form.icon" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
                    @foreach(['fence', 'door_sliding', 'garage_door', 'door_front', 'roller_shades', 'grid_on', 'grass', 'construction', 'build', 'grid_view', 'architecture', 'handyman', 'engineering', 'precision_manufacturing', 'design_services', 'home_repair_service', 'settings', 'star', 'verified', 'shield'] as $icon)
                        <option value="{{ $icon }}">{{ $icon }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Açıklama</label>
                <textarea x-model="form.description" rows="3" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none resize-none"></textarea>
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Özellikler (virgülle ayırın)</label>
                <input x-model="form.features" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none" placeholder="Özellik 1, Özellik 2, ...">
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Sıra</label>
                <input type="number" x-model="form.order" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
            </div>
        </div>

        <!-- Görsel Yükleme -->
        <div class="border-t border-outline-variant/30 pt-4">
            <label class="font-label-bold text-label-bold text-on-surface block mb-3">Görsel</label>
            <div class="flex items-start gap-4 flex-wrap">
                <!-- Önizleme -->
                <div x-show="form.image_url" class="relative w-40 h-32 rounded-lg overflow-hidden border border-outline-variant/30 flex-shrink-0">
                    <img :src="form.image_url" class="w-full h-full object-cover">
                    <button @click="form.image_url = ''" class="absolute top-1 right-1 bg-black/60 text-white p-0.5 rounded-full hover:bg-red-600 transition-colors">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </button>
                </div>
                <!-- Yükleme alanı -->
                <div class="flex-1 min-w-[250px]">
                    <div class="flex gap-2 mb-2">
                        <label class="bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md cursor-pointer hover:border-primary-container transition-colors inline-flex items-center gap-2">
                            <span class="material-symbols-outlined">upload</span>
                            <span>Bilgisayardan Seç</span>
                            <input type="file" @change="uploadImage" accept="image/*" class="hidden">
                        </label>
                        <span x-show="uploading" class="text-primary-container font-label-bold self-center">Yükleniyor...</span>
                    </div>
                    <div class="relative">
                        <input x-model="form.image_url" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none text-sm" placeholder="veya URL yapıştırın...">
                        <span class="absolute right-2 top-1/2 -translate-y-1/2 text-on-surface-variant text-xs">URL</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-2 border-t border-outline-variant/30 pt-4">
            <input type="checkbox" x-model="form.active" id="active" class="rounded">
            <label for="active" class="font-label-bold text-label-bold text-on-surface">Aktif</label>
        </div>

        <div class="flex gap-2">
            <button @click="save()" class="bg-primary-container text-on-primary-container font-label-bold text-label-bold px-6 py-2 rounded hover:bg-primary-container/90 transition-colors" x-text="editing ? 'Güncelle' : 'Ekle'"></button>
            <button x-show="editing" @click="resetForm()" class="bg-surface-container-high text-on-surface-variant font-label-bold text-label-bold px-6 py-2 rounded hover:bg-surface-container-highest transition-colors">İptal</button>
        </div>
    </div>

    <div class="space-y-2">
        <template x-for="item in items" :key="item.id">
            <div class="glass-panel p-4 rounded-lg flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <template x-if="item.image_url">
                        <img :src="item.image_url" class="w-14 h-10 rounded object-cover flex-shrink-0">
                    </template>
                    <template x-if="!item.image_url">
                        <span class="material-symbols-outlined text-2xl text-primary-container flex-shrink-0" x-text="item.icon"></span>
                    </template>
                    <div>
                        <span class="font-label-bold text-label-bold text-on-surface" x-text="item.title"></span>
                        <span class="text-on-surface-variant text-sm ml-2" x-text="'Sıra: ' + item.order"></span>
                        <span x-show="!item.active" class="text-error text-sm ml-2">(Pasif)</span>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button @click="edit(item)" class="text-primary-container hover:bg-primary-container/10 p-2 rounded transition-colors">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                    <button @click="destroy(item.id)" class="text-error hover:bg-error/10 p-2 rounded transition-colors">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </div>
        </template>
    </div>
</div>
@endsection

@push('scripts')
<script>
function hizmetlerCRUD() {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const endpoint = '/admin/api/services';
    return {
        items: [],
        form: { title: '', description: '', icon: 'fence', image_url: '', features: '', order: 0, active: true },
        editing: null,
        uploading: false,
        async fetchData() {
            const res = await fetch(endpoint, { headers: { 'Accept': 'application/json' } });
            this.items = await res.json();
        },
        async uploadImage(e) {
            const file = e.target.files[0];
            if (!file) return;
            this.uploading = true;
            const formData = new FormData();
            formData.append('file', file);
            const res = await fetch('/admin/api/media', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrf },
                body: formData,
            });
            const data = await res.json();
            this.form.image_url = data.url;
            this.uploading = false;
            e.target.value = '';
        },
        async save() {
            const method = this.editing ? 'PUT' : 'POST';
            const url = this.editing ? `${endpoint}/${this.editing}` : endpoint;
            await fetch(url, {
                method,
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf },
                body: JSON.stringify(this.form),
            });
            this.resetForm();
            await this.fetchData();
        },
        edit(item) {
            this.form = { ...item };
            this.editing = item.id;
        },
        async destroy(id) {
            if (!confirm('Silmek istediğinize emin misiniz?')) return;
            await fetch(`${endpoint}/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': csrf } });
            await this.fetchData();
        },
        resetForm() {
            this.form = { title: '', description: '', icon: 'fence', image_url: '', features: '', order: 0, active: true };
            this.editing = null;
        },
    };
}
</script>
@endpush
