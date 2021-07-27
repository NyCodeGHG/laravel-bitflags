<?php

namespace AwStudio\Bitflags\Tests\TestSupport;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestModelFactory extends Factory
{
    protected $model = TestModel::class;

    public function definition()
    {
        return [
            'status' => rand(1, 7),
        ];
    }
}
