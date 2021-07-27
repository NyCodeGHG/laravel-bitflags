<?php

namespace AwStudio\Bitflags\Tests;

use AwStudio\Bitflags\Tests\TestSupport\TestModel;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModifiyBitflagsTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_will_add_the_flag_to_bitmask()
    {
        $model = TestModel::factory(['status' => 1])->create();
        $this->assertDatabaseHas('test_models', ['status' => 1]);

        $model->update([
            'status' => addBitflag(2, $model->status),
        ]);

        $this->assertDatabaseHas('test_models', ['status' => 3]);
    }

    public function test_it_will_add_multiple_flags_to_the_bitmask()
    {
        $model = TestModel::factory(['status' => 1])->create();
        $this->assertDatabaseHas('test_models', ['status' => 1]);

        $model->update([
            'status' => addBitflag([2, 4], $model->status),
        ]);

        $this->assertDatabaseHas('test_models', ['status' => 7]);
    }

    public function test_it_will_remove_the_flag_from_bitmask()
    {
        $model = TestModel::factory(['status' => 3])->create();
        $this->assertDatabaseHas('test_models', ['status' => 3]);

        $model->update([
            'status' => removeBitflag(1, $model->status),
        ]);

        $this->assertDatabaseHas('test_models', ['status' => 2]);
    }

    public function test_it_will_remove_multiple_flags_from_bitmask()
    {
        $model = TestModel::factory(['status' => 7])->create();
        $this->assertDatabaseHas('test_models', ['status' => 7]);

        $model->update([
            'status' => removeBitflag([2, 4], $model->status),
        ]);

        $this->assertDatabaseHas('test_models', ['status' => 1]);
    }
}
