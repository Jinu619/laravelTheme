<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        view()->composer('layout.master',  'App\Http\ViewComposers\ThemeComposer@currentMenuInformation');
        view()->composer('layout.sidebar',  'App\Http\ViewComposers\ThemeComposer@compose');
        view()->composer('layout.header',  'App\Http\ViewComposers\ThemeComposer@userIcon');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
