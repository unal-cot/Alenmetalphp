@extends('layouts.admin')
@section('title', 'Mesajlar')

@section('content')
<div x-data="mesajlar()" x-init="fetchData()">
    <h1 class="font-headline-xl text-headline-xl text-primary-container mb-8">Mesajlar</h1>

    <div class="space-y-4">
        <template x-for="msg in items" :key="msg.id">
            <div class="glass-panel rounded-lg overflow-hidden">
                <div class="p-4 flex items-center justify-between cursor-pointer" @click="msg._open = !msg._open">
                    <div class="flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary-container" x-text="msg.read ? 'mail' : 'mark_email_unread'"></span>
                        <div>
                            <div class="font-label-bold text-label-bold text-on-surface" x-text="msg.name"></div>
                            <div class="text-on-surface-variant text-sm" x-text="new Date(msg.created_at).toLocaleDateString('tr-TR')"></div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button @click.stop="toggleRead(msg)" class="text-primary-container hover:bg-primary-container/10 p-2 rounded transition-colors">
                            <span class="material-symbols-outlined" x-text="msg.read ? 'mark_email_unread' : 'mark_email_read'"></span>
                        </button>
                        <button @click.stop="destroy(msg.id)" class="text-error hover:bg-error/10 p-2 rounded transition-colors">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                        <span class="material-symbols-outlined text-on-surface-variant transition-transform" :class="msg._open ? 'rotate-180' : ''">expand_more</span>
                    </div>
                </div>
                <div x-show="msg._open" class="px-4 pb-4 border-t border-outline-variant/20 pt-4 space-y-2">
                    <template x-if="msg.email">
                        <div class="flex items-center gap-2 text-on-surface-variant">
                            <span class="material-symbols-outlined text-sm">email</span>
                            <span x-text="msg.email"></span>
                        </div>
                    </template>
                    <template x-if="msg.phone">
                        <div class="flex items-center gap-2 text-on-surface-variant">
                            <span class="material-symbols-outlined text-sm">call</span>
                            <span x-text="msg.phone"></span>
                        </div>
                    </template>
                    <div class="text-on-surface mt-2" x-text="msg.message"></div>
                </div>
            </div>
        </template>
        <p x-show="items.length === 0" class="text-on-surface-variant text-center py-12">Henüz mesaj yok.</p>
    </div>
</div>
@endsection

@push('scripts')
<script>
function mesajlar() {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const endpoint = '/admin/api/contact-messages';
    return {
        items: [],
        async fetchData() {
            this.items = await fetch(endpoint, { headers: { 'Accept': 'application/json' } }).then(r => r.json());
            this.items.forEach(m => m._open = false);
        },
        async toggleRead(msg) {
            await fetch(`${endpoint}/${msg.id}`, { method: 'PUT', headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf }, body: JSON.stringify({ read: !msg.read }) });
            await this.fetchData();
        },
        async destroy(id) { if (!confirm('Emin misiniz?')) return; await fetch(`${endpoint}/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': csrf } }); await this.fetchData(); },
    };
}
</script>
@endpush
