<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;

use App\User;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testApplication()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testLoginForm()
    {
        factory(User::class)->create([
            'name' => 'Test',
            'email' => 'test@test.io',
            'password' => '111111'
        ]);

        $response = $this->post('/login', [
            'name' => 'Test',
            'email' => 'test@test.io',
            'password' => '111111'
        ]);

        if (Auth::check()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

//        $this->assertTrue(Auth::user()->name == 'Test');
//        $response->assertViewIs('task');
    }

    public function testLoginForm2()
    {
        factory(User::class)->create([
            'name' => 'Test2',
            'email' => 'test2@test.io',
            'password' => '111111'
        ]);

        $response = $this->post('/login', [
            'name' => 'Test2',
            'email' => 'test2@test.io',
            'password' => '111111'
        ]);

//        $response->assertTrue($response->user()->name == 'Test');
        $response->assertViewIs('task');
    }
}
