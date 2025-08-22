<?php

namespace Tests\Unit;

use Tests\TestCase;

class SimpleTest extends TestCase
{
    public function test_basic_test()
    {
        $this->assertTrue(true);
    }

    public function test_environment_is_testing()
    {
        $this->assertEquals('testing', app()->environment());
    }

    public function test_database_connection_is_sqlite()
    {
        $this->assertEquals('sqlite', config('database.default'));
    }
}
