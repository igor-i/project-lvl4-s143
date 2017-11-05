<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testApplication()
    {
        $this->get('/register')
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testRegister()
    {
        $this->post('/register', [
            'name' => 'test',
            'email' => 'test@test.io',
            'password' => '111111',
            'password_confirmation' => '111111',
            '_token' => csrf_token()
        ])->assertRedirect('/tasks');

        $this->assertDatabaseHas('users', [
            'email' => 'test@test.io'
        ]);
    }
}
