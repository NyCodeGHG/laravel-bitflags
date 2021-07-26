<?php

namespace AwStudio\Bitmask;

use AwStudio\Bitmask\Bitmask;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use AwStudio\Bitmask\Facades\Bitmask as BitmaskFacade;

class BitmaskServiceProvider extends ServiceProvider
{
    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Bitmask', BitmaskFacade::class);

        $this->app->bind('bitmask', function () {
            return new Bitmask;
        });
    }

    /**
     * Boot application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
