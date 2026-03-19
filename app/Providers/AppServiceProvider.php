<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        if (!app()->runningInConsole()) {
            view()->share('globalCategories', \App\Models\Kategori::all());
            view()->share('globalLatestNews', \App\Models\Article::where('status', 'published')->latest()->take(5)->get());
        }
    }
}