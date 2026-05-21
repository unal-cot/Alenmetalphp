@extends('layouts.admin')
@section('title', 'Medya')

@section('content')
<div x-data="medya()" x-init="fetchData()">
    <h1 class="font-headline-xl text-headline-xl text-primary-container mb-8">Medya</h1>

    <div class="glass-panel p-6 rounded-lg mb-8">
        <label class="font-label-bold text-label-bold text-on-surface block mb-2">Dosya Yükle</label>
        <div class="flex gap-4">
            <input type="file" @change="upload" accept="image/*" class="text-on-surface font-body-md file:bg-primary-container file:text-on-primary-container file:border-0 file:rounded file:px-4 file:py-2 file:font-label-bold file:cursor-pointer">
            <span x-show="uploading" class="text-primary-container font-label-bold">Yükleniyor...</span>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <template x-for="item in items" :key="item.id">
            <div class="glass-panel p-3 rounded-lg group relative">
                <img :src="item.url" :alt="item.filename" class="w-full h-32 object-cover rounded mb-2" loading="lazy">
                <p class="text-on-surface-variant text-xs truncate" x-text="item.filename"></p>
                <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                    <button @click="copyUrl(item.url)" class="bg-primary-container text-on-primary-container p-1.5 rounded text-xs" title="URL Kopyala">
                        <span class="material-symbols-outlined text-sm">content_copy</span>
                    </button>
                    <button @click="destroy(item.id)" class="bg-error text-on-error-container p-1.5 rounded text-xs">
                        <span class="material-symbols-outlined text-sm">delete</span>
                    </button>
                </div>
            </div>
        </template>
    </div>
    <p x-show="items.length === 0" class="text-on-surface-variant text-center py-12">Henüz medya yok.</p>
</div>
@endsection

@push('scripts')
<script>
function medya() {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const endpoint = '/admin/api/media';
    return {
        items: [], uploading: false,
        async fetchData() { this.items = await fetch(endpoint, { headers: { 'Accept': 'application/json' } }).then(r => r.json()); },
        async upload(e) {
            const file = e.target.files[0];
            if (!file) return;
            this.uploading = true;
            const form = new FormData();
            form.append('file', file);
            await fetch(endpoint, { method: 'POST', headers: { 'X-CSRF-TOKEN': csrf }, body: form });
            this.uploading = false;
            e.target.value = '';
            await this.fetchData();
        },
        async destroy(id) { if (!confirm('Emin misiniz?')) return; await fetch(`${endpoint}/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': csrf } }); await this.fetchData(); },
        copyUrl(url) { navigator.clipboard.writeText(url); alert('URL kopyalandı!'); },
    };
}
</script>
@endpush
