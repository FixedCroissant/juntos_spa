<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class NCSUShibbolethOverride extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $loader = AliasLoader::getInstance();

        $loader->alias('NCSU\Auth\Framework\Laravel\ShibbolethAuthenticate', 'App\Vendor\NCSUShibbolethAuthenticate');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
