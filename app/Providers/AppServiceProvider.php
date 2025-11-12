<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Kelolakontak;

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
        View::composer('layouts.layout', function ($view) {
            $view->with([
                'kontak' => Kelolakontak::first(),
            ]);
        });
        
        if(config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
    }
}
