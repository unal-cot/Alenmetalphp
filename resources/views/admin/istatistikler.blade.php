@extends('layouts.admin')
@section('title', 'İstatistikler')

@section('content')
<div x-data="istatistiklerCRUD()" x-init="fetchData()">
    <h1 class="font-headline-xl text-headline-xl text-primary-container mb-8">İstatistikler</h1>

    <div class="glass-panel p-6 rounded-lg mb-8 space-y-4">
        <h2 class="font-headline-lg text-headline-lg text-on-surface" x-text="editing ? 'İstatistik Düzenle' : 'Yeni İstatistik Ekle'"></h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Etiket</label>
                <input x-model="form.label" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none" placeholder="Tamamlanan Proje">
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Değer</label>
                <input x-model="form.value" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none" placeholder="500+">
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Sıra</label>
                <input type="number" x-model="form.order" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
            </div>
        </div>
        <div class="flex items-center gap-2">
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
                    <span class="font-stat-number text-stat-number text-primary-container" x-text="item.value"></span>
                    <span class="font-label-bold text-label-bold text-on-surface" x-text="item.label"></span>
                    <span x-show="!item.active" class="text-error text-sm">(Pasif)</span>
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
function istatistiklerCRUD() {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const endpoint = '/admin/api/stats';
    return {
        items: [], form: { label: '', value: '', order: 0, active: true }, editing: null,
        async fetchData() { this.items = await fetch(endpoint, { headers: { 'Accept': 'application/json' } }).then(r => r.json()); },
        async save() {
            const method = this.editing ? 'PUT' : 'POST';
            const url = this.editing ? `${endpoint}/${this.editing}` : endpoint;
            await fetch(url, { method, headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf }, body: JSON.stringify(this.form) });
            this.resetForm(); await this.fetchData();
        },
        edit(item) { this.form = { ...item }; this.editing = item.id; },
        async destroy(id) { if (!confirm('Emin misiniz?')) return; await fetch(`${endpoint}/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': csrf } }); await this.fetchData(); },
        resetForm() { this.form = { label: '', value: '', order: 0, active: true }; this.editing = null; },
    };
}
</script>
@endpush
