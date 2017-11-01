<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class UsersTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testApplication()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->get('/user');

        $response->assertStatus(200);
    }
}
