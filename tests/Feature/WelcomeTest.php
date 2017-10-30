<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class WelcomeTest extends TestCase
{
//    public function setUp()
//    {
//        parent::setUp();
//        Artisan::call('migrate');
//    }
//
//    public function tearDown()
//    {
//        Artisan::call('migrate:reset');
//        parent::tearDown();
//    }


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
//
//    public function testUserRegistration()
//    {
//        $response = $this->post(
//            '/register',
//            [
//                'name' => 'Test',
//                'email' => 'test@test.io',
//                'password' => '111111'
//            ]
//        );
//        $response->assertStatus(200);
//        $this->assertDatabaseHas('users', ['email' => 'test@test.io']);
//    }

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

//        $response = $this->get('/');
        $response->assertRedirect('/tasks');
    }
}
