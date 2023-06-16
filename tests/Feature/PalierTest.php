<?php

namespace Tests\Feature;

use App\Models\Palier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PalierTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertEquals(7800000, Palier::calculate_commision(55000000));
        $this->assertEquals(60000, Palier::calculate_commision(2000000));

    }
}
