<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class WelcomeTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic request test / for guest user.
     *
     * @return void
     */
    public function testRedirectGuest()
    {
        $response = $this->get('/');
        $response->assertRedirect('/welcome');
    }

    /**
     * A basic response test /welcome.
     *
     * @return void
     */
    public function testApplication()
    {
        $responseWelcome = $this->get('/welcome');
        $responseWelcome->assertStatus(200);
    }

    /**
     * A basic request test / for auth user.
     *
     * @return void
     */
    public function testRedirectAuth()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->get('/');

        $response->assertRedirect('/task');
    }
}
