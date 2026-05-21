@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div x-data="dashboard()" x-init="load()">
    <h1 class="font-headline-xl text-headline-xl text-primary-container mb-8">Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
        <div class="glass-panel p-6 rounded-lg">
            <span class="material-symbols-outlined text-3xl text-primary-container mb-2">construction</span>
            <p class="text-on-surface-variant font-body-md">Toplam Hizmet</p>
            <p class="font-stat-number text-stat-number text-primary-container" x-text="counts.services">-</p>
        </div>
        <div class="glass-panel p-6 rounded-lg">
            <span class="material-symbols-outlined text-3xl text-primary-container mb-2">photo_library</span>
            <p class="text-on-surface-variant font-body-md">Toplam Proje</p>
            <p class="font-stat-number text-stat-number text-primary-container" x-text="counts.projects">-</p>
        </div>
        <div class="glass-panel p-6 rounded-lg">
            <span class="material-symbols-outlined text-3xl text-primary-container mb-2">mail</span>
            <p class="text-on-surface-variant font-body-md">Toplam Mesaj</p>
            <p class="font-stat-number text-stat-number text-primary-container" x-text="counts.messages">-</p>
        </div>
        <div class="glass-panel p-6 rounded-lg">
            <span class="material-symbols-outlined text-3xl text-primary-container mb-2">mark_email_unread</span>
            <p class="text-on-surface-variant font-body-md">Okunmamış Mesaj</p>
            <p class="font-stat-number text-stat-number text-primary-container" x-text="counts.unreadMessages">-</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function dashboard() {
    return {
        counts: { services: 0, projects: 0, messages: 0, unreadMessages: 0 },
        async load() {
            const [services, projects, messages] = await Promise.all([
                fetch('/admin/api/services', { headers: { 'Accept': 'application/json' } }).then(r => r.json()),
                fetch('/admin/api/projects', { headers: { 'Accept': 'application/json' } }).then(r => r.json()),
                fetch('/admin/api/contact-messages', { headers: { 'Accept': 'application/json' } }).then(r => r.json()),
            ]);
            this.counts.services = services.length;
            this.counts.projects = projects.length;
            this.counts.messages = messages.length;
            this.counts.unreadMessages = messages.filter(m => !m.read).length;
        }
    };
}
</script>
@endpush
