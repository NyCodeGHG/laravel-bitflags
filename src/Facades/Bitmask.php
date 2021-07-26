<?php

namespace AwStudio\Bitmask\Facades;

use Illuminate\Support\Facades\Facade;

class Bitmask extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bitmask';
    }
}
