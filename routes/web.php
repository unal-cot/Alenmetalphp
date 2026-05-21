<?php

use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Public pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/hizmetler', [PageController::class, 'services'])->name('services');
Route::get('/kurumsal', [PageController::class, 'about'])->name('about');
Route::get('/galeri', [PageController::class, 'gallery'])->name('gallery');
Route::redirect('/iletisim', '/#iletisim');
Route::get('/gizlilik-politikasi', [PageController::class, 'privacy'])->name('privacy');
Route::get('/kullanim-kosullari', [PageController::class, 'terms'])->name('terms');

// Public contact form submission
Route::post('/iletisim', [ContactMessageController::class, 'store']);

// Auth routes (Breeze provides /login, /logout, etc.)
require __DIR__.'/auth.php';

// Admin panel (protected by auth middleware)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', fn () => view('admin.dashboard'))->name('admin.dashboard');
    Route::get('/hizmetler', fn () => view('admin.hizmetler'))->name('admin.hizmetler');
    Route::get('/projeler', fn () => view('admin.projeler'))->name('admin.projeler');
    Route::get('/istatistikler', fn () => view('admin.istatistikler'))->name('admin.istatistikler');
    Route::get('/mesajlar', fn () => view('admin.mesajlar'))->name('admin.mesajlar');
    Route::get('/medya', fn () => view('admin.medya'))->name('admin.medya');
    Route::get('/kullanicilar', fn () => view('admin.kullanicilar'))->name('admin.kullanicilar');
    Route::get('/ayarlar', fn () => view('admin.ayarlar'))->name('admin.ayarlar');

    // Admin API endpoints
    Route::prefix('api')->group(function () {
        // Services
        Route::get('services', [\App\Http\Controllers\ServiceController::class, 'index']);
        Route::post('services', [\App\Http\Controllers\ServiceController::class, 'store']);
        Route::put('services/{id}', [\App\Http\Controllers\ServiceController::class, 'update']);
        Route::delete('services/{id}', [\App\Http\Controllers\ServiceController::class, 'destroy']);
        // Projects
        Route::get('projects', [\App\Http\Controllers\ProjectController::class, 'index']);
        Route::post('projects', [\App\Http\Controllers\ProjectController::class, 'store']);
        Route::put('projects/{id}', [\App\Http\Controllers\ProjectController::class, 'update']);
        Route::delete('projects/{id}', [\App\Http\Controllers\ProjectController::class, 'destroy']);
        // Stats
        Route::get('stats', [\App\Http\Controllers\StatController::class, 'index']);
        Route::post('stats', [\App\Http\Controllers\StatController::class, 'store']);
        Route::put('stats/{id}', [\App\Http\Controllers\StatController::class, 'update']);
        Route::delete('stats/{id}', [\App\Http\Controllers\StatController::class, 'destroy']);
        // Contact Messages
        Route::get('contact-messages', [ContactMessageController::class, 'index']);
        Route::put('contact-messages/{id}', [ContactMessageController::class, 'update']);
        Route::delete('contact-messages/{id}', [ContactMessageController::class, 'destroy']);
        // Media
        Route::get('media', [\App\Http\Controllers\MediaController::class, 'index']);
        Route::post('media', [\App\Http\Controllers\MediaController::class, 'store']);
        Route::delete('media/{id}', [\App\Http\Controllers\MediaController::class, 'destroy']);
        // Users
        Route::get('users', [\App\Http\Controllers\UserController::class, 'index']);
        Route::post('users', [\App\Http\Controllers\UserController::class, 'store']);
        Route::put('users/{id}', [\App\Http\Controllers\UserController::class, 'update']);
        Route::delete('users/{id}', [\App\Http\Controllers\UserController::class, 'destroy']);
        // Site Config
        Route::get('site-config', [\App\Http\Controllers\SiteConfigController::class, 'index']);
        Route::put('site-config', [\App\Http\Controllers\SiteConfigController::class, 'update']);
    });
});
