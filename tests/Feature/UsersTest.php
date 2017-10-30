<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        factory(User::class)->create([
            'name' => 'Test',
            'email' => 'test@test.io',
        ]);

        $response = $this->get('/users');
        $response->assertStatus(200);
    }
}
