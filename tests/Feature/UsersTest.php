<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    /**
     * @return void
     */
    public function testApplication()
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
    }
}
