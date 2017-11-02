<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;
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

        //TODO:
        //- сгенерить CSRF token
        //- поставить куку с XSRF-TOKEN (вместе с запросом responce можно)
        //- прочитать куку и вставить заголовок X-XSRF-TOKEN

//        $response = $this->call('POST', '/login', [
//            'email' => 'badUsername@gmail.com',
//            'password' => 'badPass',
//            '_token' => csrf_token()
//        ]);
//        $this->assertEquals(200, $response->getStatusCode());
//        $this->assertEquals('auth.login', $response->original->name());

        $response = $this->post('/register', [
            'name' => 'Test',
            'email' => 'test@test.io',
            'password' => '111111',
            '_token' => csrf_token()
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@test.io'
        ]);

//        TODO проверить создаётся ли пользователь вообще
//        $response->assertRedirect('/task');
    }
}
