<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    /**
     * @return void
     */
    public function testApplication()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }
}
