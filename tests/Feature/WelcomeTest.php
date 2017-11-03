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
        $this->get('/')
            ->assertRedirect('/welcome');
    }

    /**
     * A basic response test /welcome.
     *
     * @return void
     */
    public function testApplication()
    {
        $this->get('/welcome')
            ->assertStatus(200);
    }

    /**
     * A basic request test / for auth user.
     *
     * @return void
     */
    public function testRedirectAuth()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/')
            ->assertRedirect('/task');
    }
}
