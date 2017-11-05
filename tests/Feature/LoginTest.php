<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testApplication()
    {
        $this->get('/login')
            ->assertStatus(200);
    }

//    public function testLogin()
//    {
//        $user = factory(User::class)->create();
//
//        $this->get('/login');
//
//        $this->post('/login', [
//            'email' => $user->email,
//            'password' => $user->password,
//            '_token' => csrf_token()
//        ])->assertRedirect('/tasks');
//    }
}
