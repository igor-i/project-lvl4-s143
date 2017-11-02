<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class RegisterTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testApplication()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function testRegister()
    {
        factory(User::class)->create([
            'name' => 'Test',
            'email' => 'test@test.io',
            'password' => '111111'
        ]);

//        $this->get('/login');
        $response = $this->post('/user', [
            'email' => 'test@test.io',
            'password' => '111111'
        ]);

//        TODO проверить создаётся ли пользователь вообще
        $response->assertRedirect('/task');
    }
}
