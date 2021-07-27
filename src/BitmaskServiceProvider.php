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
        Builder::macro('whereBitmask', function (string $column, int $bit) {
            return $this->where($column, '&', $bit);
        });
        Builder::macro('whereBitmaskNot', function (string $column, int $bit) {
            return $this->where(function () use ($column, $bit) {
                return $this->whereRAW('NOT '.$column.' & ' . $bit)
                    ->orWhereNull($column);
            });
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
