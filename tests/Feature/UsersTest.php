<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class UsersTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testApplication()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/user')
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testDeleteUser()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/user/1/edit')
            ->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'email' => $user->email
        ]);

        $this->post('/user/1', [
            '_method' => 'DELETE',
            '_token' => csrf_token()
        ]);

        $this->assertDatabaseMissing('users', [
            'email' => $user->email
        ]);
    }

    /**
     * @return void
     */
    public function testUpdateUser()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/user/1/edit')
            ->assertStatus(200);

        $this->post('/user/1', [
            'name' => $user->name,
            'email' => 'test@test.io',
            'password' => $user->password,
            'password_confirmation' => $user->password,
            '_method' => 'PATCH',
            '_token' => csrf_token()
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@test.io'
        ]);
    }
}
