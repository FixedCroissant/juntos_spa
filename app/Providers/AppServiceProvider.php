<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

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
        //Fix access violation: 1071 Specified key was too long error when migrating.
        Schema::defaultStringLength(191);

        Blade::if('roles', function (array $roles) {
            foreach($roles as $role){
                return in_array($role,Auth::user()->roles->pluck('slug')->toArray(),true) ? true : false;
            }
        });
    }
}
