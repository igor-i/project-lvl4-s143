<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeTest extends TestCase
{
    /**
     * A basic response test - /.
     *
     * @return void
     */
    public function testApplicationRoot()
    {
        $response = $this->get('/');
        $response->assertRedirect('/welcome');
//        $response->assertStatus(200);
    }

    /**
     * A basic response test - /welcome.
     *
     * @return void
     */
    public function testApplicationWelcome()
    {
        $responseWelcome = $this->get('/welcome');
        $responseWelcome->assertStatus(200);
    }
}
