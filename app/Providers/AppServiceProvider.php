<?php

namespace App\Providers;

use App\Models\SiteConfig;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('admin', fn (User $user) => $user->role === 'ADMIN');

        View::composer(['layouts.public', 'partials.footer', 'partials.contact-form'], function ($view) {
            $view->with('config', SiteConfig::pluck('value', 'key')->toArray());
        });
    }
}
