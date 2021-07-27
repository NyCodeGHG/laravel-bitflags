<?php

namespace AwStudio\Bitmask;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;

class BitmaskServiceProvider extends ServiceProvider
{
    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBuilderMacros();
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

    /**
     * Register the bitflag builder macros.
     *
     * @return void
     */
    public function registerBuilderMacros()
    {
        Builder::macro('whereBitflag', function (string $column, int $flag) {
            return $this->where($column, '&', $flag);
        });
        Builder::macro('whereBitflags', function (string $column, array|int $flags) {
            $flags = getBitmask($flags);
            return $this->whereRaw("$column & $flags = $flags");
        });
        Builder::macro('whereBitflagIn', function (string $column, array|int $flags) {
            $flags = getBitmask($flags);
            return $this->whereRaw("$column & $flags");
        });
        Builder::macro('whereBitflagNot', function (string $column, int $flag) {
            return $this->where(function () use ($column, $flag) {
                return $this->whereRAW('NOT '.$column.' & ' . $flag)
                    ->orWhereNull($column);
            });
        });
    }
}
