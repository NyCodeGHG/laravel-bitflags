<?php

namespace AwStudio\Bitflags\Tests\TestSupport;

use AwStudio\Bitflags\Casts\Bitflags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    public const FOO = 1;

    public const BAR = 2;

    public const BAZ = 4;

    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public static function newFactory()
    {
        return \AwStudio\Bitflags\Tests\TestSupport\TestModelFactory::new();
    }

    protected $casts = [
        'status' => Bitflags::class,
    ];
}
