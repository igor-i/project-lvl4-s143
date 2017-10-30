<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeTest extends TestCase
{
    /**
     * A basic response test.
     *
     * @return void
     */
    public function testApplication()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
