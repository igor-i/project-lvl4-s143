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
            ->get('/users')
            ->assertStatus(200);
    }

    /**
     * Update user
     *
     * @return void
     */
    public function testUpdateUser()
    {
        $user = factory(User::class)->create();
        $newUser = factory(User::class)->make();

        $this->actingAs($user)
            ->get("/users/{$user->id}/edit")
            ->assertStatus(200);

        $this->post("/users/{$user->id}", [
            'name' => $user->name,
            'email' => $newUser->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
            '_method' => 'PATCH',
            '_token' => csrf_token()
        ])->assertRedirect("/users/{$user->id}/edit");

        $this->assertDatabaseHas('users', [
            'email' => $newUser->email
        ]);
    }

    /**
     * Delete user
     *
     * @return void
     */
    public function testDeleteUser()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get("/users/{$user->id}/edit")
            ->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'email' => $user->email
        ]);

        $this->post("/users/{$user->id}", [
            '_method' => 'DELETE',
            '_token' => csrf_token()
        ]);

        $this->assertDatabaseMissing('users', [
            'email' => $user->email
        ]);
    }

    /**
     * Filtered user
     */
    public function testFilterUser()
    {
        $user = factory(User::class)->create();

        $response1 = $this->actingAs($user)
            ->get("/users?name=test")
            ->assertViewHas('users');

        $count = count($response1->original->getData()['users']);

        factory(User::class)->create(['name' => 'test']);
        factory(User::class)->create(['name' => 'onemoretest']);
        factory(User::class)->create(['name' => 'someelse']);

        $response2 = $this->actingAs($user)
            ->get("/users?name=test")
            ->assertViewHas('users');

        $this->assertCount($count + 2, $response2->original->getData()['users']);
    }
}
