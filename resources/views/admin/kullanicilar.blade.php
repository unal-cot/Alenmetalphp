@extends('layouts.admin')
@section('title', 'Kullanıcılar')

@section('content')
<div x-data="kullanicilarCRUD()" x-init="fetchData()">
    <h1 class="font-headline-xl text-headline-xl text-primary-container mb-8">Kullanıcılar</h1>

    <div class="glass-panel p-6 rounded-lg mb-8 space-y-4">
        <h2 class="font-headline-lg text-headline-lg text-on-surface" x-text="editing ? 'Kullanıcı Düzenle' : 'Yeni Kullanıcı Ekle'"></h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Ad</label>
                <input x-model="form.name" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">E-posta</label>
                <input type="email" x-model="form.email" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Şifre <span class="text-on-surface-variant">(değiştirmek istemiyorsanız boş bırakın)</span></label>
                <input type="password" x-model="form.password" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
            </div>
            <div>
                <label class="font-label-bold text-label-bold text-on-surface block mb-2">Rol</label>
                <select x-model="form.role" class="w-full bg-surface-container border border-outline-variant rounded px-4 py-2 text-on-surface font-body-md focus:border-primary-container focus:outline-none">
                    <option value="EDITOR">EDITOR</option>
                    <option value="ADMIN">ADMIN</option>
                </select>
            </div>
        </div>
        <div class="flex gap-2">
            <button @click="save()" class="bg-primary-container text-on-primary-container font-label-bold text-label-bold px-6 py-2 rounded hover:bg-primary-container/90 transition-colors" x-text="editing ? 'Güncelle' : 'Ekle'"></button>
            <button x-show="editing" @click="resetForm()" class="bg-surface-container-high text-on-surface-variant font-label-bold text-label-bold px-6 py-2 rounded hover:bg-surface-container-highest transition-colors">İptal</button>
        </div>
    </div>

    <div class="space-y-2">
        <template x-for="item in items" :key="item.id">
            <div class="glass-panel p-4 rounded-lg flex items-center justify-between">
                <div>
                    <span class="font-label-bold text-label-bold text-on-surface" x-text="item.name"></span>
                    <span class="text-on-surface-variant text-sm ml-2" x-text="item.email"></span>
                    <span class="text-primary-container text-sm ml-2" x-text="item.role"></span>
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
function kullanicilarCRUD() {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const endpoint = '/admin/api/users';
    return {
        items: [], form: { name: '', email: '', password: '', role: 'EDITOR' }, editing: null,
        async fetchData() {
            try { this.items = await fetch(endpoint, { headers: { 'Accept': 'application/json' } }).then(r => r.json()); }
            catch (e) { this.items = []; }
        },
        async save() {
            const method = this.editing ? 'PUT' : 'POST';
            const url = this.editing ? `${endpoint}/${this.editing}` : endpoint;
            const body = { ...this.form };
            if (this.editing && !body.password) delete body.password;
            await fetch(url, { method, headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf }, body: JSON.stringify(body) });
            this.resetForm(); await this.fetchData();
        },
        edit(item) { this.form = { name: item.name, email: item.email, password: '', role: item.role }; this.editing = item.id; },
        async destroy(id) { if (!confirm('Emin misiniz?')) return; await fetch(`${endpoint}/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': csrf } }); await this.fetchData(); },
        resetForm() { this.form = { name: '', email: '', password: '', role: 'EDITOR' }; this.editing = null; },
    };
}
</script>
@endpush
