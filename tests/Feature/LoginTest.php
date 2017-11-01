<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    public function testAuthenticate()
    {
        factory(User::class)->create([
            'name' => 'Test',
            'email' => 'test@test.io',
            'password' => '111111'
        ]);

        if (Auth::attempt([
            'name' => 'Test',
            'email' => 'test@test.io',
            'password' => '111111'
        ])) {
            // Authentication passed...
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
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

        if ($response->Auth::check()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

//        $response->assertTrue($request->Auth::user()->name == 'Test');
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
