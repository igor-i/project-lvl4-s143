<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * @return void
     */
    public function testApplication()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
}
