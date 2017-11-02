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



    public function testRegister1()
    {
//        factory(User::class)->create([
//            'name' => 'Test',
//            'email' => 'test1@test.io',
//            'password' => '111111'
//        ]);

        $response = $this->put('/register', [
            'name' => 'Test',
            'email' => 'test@test.io',
            'password' => '111111'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@test.io'
        ]);

//        TODO проверить создаётся ли пользователь вообще
//        $response->assertRedirect('/task');
    }
}
