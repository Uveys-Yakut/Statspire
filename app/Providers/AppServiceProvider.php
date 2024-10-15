<?php

namespace App\Providers;

use App\View\Docs\HeaderComponent;
use App\View\Docs\MenuComponent;
use Illuminate\Support\Facades\Blade;
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
        Blade::component('docs.menu', MenuComponent::class);
        Blade::component('docs.header', HeaderComponent::class);
    }
}
