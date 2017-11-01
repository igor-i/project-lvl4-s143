<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;

use App\User;

class LoginTest extends TestCase
{
    use DatabaseMigrations;
//    use RefreshDatabase;

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

        $this->assertTrue($response->Auth::user()->name == 'Test');
//        $response->assertViewIs('task');
    }
}
