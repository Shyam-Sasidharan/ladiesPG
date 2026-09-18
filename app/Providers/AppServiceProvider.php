<?php

namespace App\Providers;

use App\Models\PgNotification;
use App\Models\PgSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', fn ($user) => (bool) $user->is_admin);
        Paginator::defaultView('components.pagination');
        View::composer('layouts.app', function ($view) {
            $view->with('property', PgSetting::first());
            $view->with('unreadCount', PgNotification::whereNull('read_at')->count());
        });
    }
}
