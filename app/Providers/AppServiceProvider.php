<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        //Force HTTPS if used on a production environment
        if(config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
        
        
        //Fix access violation: 1071 Specified key was too long error when migrating.
        Schema::defaultStringLength(191);
    }
}
