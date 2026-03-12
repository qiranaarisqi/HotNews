<?php

namespace App\Providers;

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
        if (!app()->runningInConsole()) {
            view()->share('globalCategories', \App\Models\Kategori::all());
            view()->share('globalLatestNews', \App\Models\Article::where('status', 'published')->latest()->take(5)->get());
        }
    }
}
