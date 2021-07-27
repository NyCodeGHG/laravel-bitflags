<?php

namespace AwStudio\Bitflags\Tests;

use AwStudio\Bitflags\Tests\TestSupport\TestModel;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScopeBitFlagsTest extends TestCase
{
    use RefreshDatabase;

    public function test_where_bitflag_scope_will_find_matching_entries()
    {
        TestModel::factory(['status' => TestModel::FOO])->count(3)->create();
        TestModel::factory(['status' => [TestModel::FOO, TestModel::BAZ]])->count(2)->create();
        $this->assertCount(5, TestModel::whereBitflag('status', TestModel::FOO)->get());
    }

    public function test_where_bitflag_not_scope_will_return_matching_entries()
    {
        TestModel::factory(['status' => TestModel::FOO])->create();
        TestModel::factory(['status' => [TestModel::FOO, TestModel::BAR]])->create();
        $this->assertCount(0, TestModel::whereBitflagNot('status', TestModel::FOO)->get());
    }

    public function test_where_bitflag_in_scope_will_return_all_entries_where_on_flag_is_set()
    {
        TestModel::factory(['status' => TestModel::FOO])->create();
        TestModel::factory(['status' => [TestModel::FOO, TestModel::BAR]])->create();

        $this->assertCount(2, TestModel::whereBitflagIn('status', [
            TestModel::FOO,
            TestModel::BAR,
        ])->get());

        $this->assertCount(1, TestModel::whereBitflagIn('status', [
            TestModel::BAR,
        ])->get());
    }

    public function test_where_bitflags_scope_returns_all_entries_where_all_specified_flas_are_set()
    {
        TestModel::factory(['status' => TestModel::FOO])->create();
        TestModel::factory(['status' => [TestModel::FOO, TestModel::BAR]])->create();

        $this->assertCount(1, TestModel::whereBitflags('status', [
            TestModel::FOO,
            TestModel::BAR,
        ])->get());
        $this->assertCount(1, TestModel::whereBitflags('status', [
            TestModel::BAR,
        ])->get());
    }
}
