<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_add()
    {
        $num1 = 1;
        $num2 = 1;
        $sum = \App\Http\Controllers\TestController::add($num1, $num2);
        $this->assertEquals(2, $sum);
    }

}
