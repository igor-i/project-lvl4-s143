<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;
use App\Status;

class StatusesTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testApplication()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/status')
            ->assertStatus(200);
    }

    /**
     * Create status
     *
     * @return void
     */
    public function testCreateStatus()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/status/create')
            ->assertStatus(200);

        $status = factory(Status::class)->make();

        $this->post("/status", [
            'name' => $status->name,
        ])->assertRedirect('/status/create');

        $this->assertDatabaseHas('TaskStatuses', [
            'name' => $status->name
        ]);
    }

    /**
     * Update status
     *
     * @return void
     */
    public function testUpdateStatus()
    {
        $user = factory(User::class)->create();

        $status = Status::first();
        $newStatus = factory(Status::class)->make();

        $this->actingAs($user)
            ->get("/status/{$status->id}/edit")
            ->assertStatus(200);

        $this->post("/status/{$status->id}", [
            'name' => $newStatus->name,
            '_method' => 'PATCH',
            '_token' => csrf_token()
        ])->assertRedirect("/status/{$status->id}/edit");

        $this->assertDatabaseHas('TaskStatuses', [
            'name' => $newStatus->name
        ]);
    }

    /**
     * Delete status
     *
     * @return void
     */
    public function testDeleteStatus()
    {
        $user = factory(User::class)->create();
        $status = Status::first();

        $this->actingAs($user)
            ->get("/status/{$status->id}/edit")
            ->assertStatus(200);

        $this->post("/status/{$status->id}", [
            '_method' => 'DELETE',
            '_token' => csrf_token()
        ]);

        $this->assertDatabaseMissing('TaskStatuses', [
            'id' => $status->id
        ]);
    }
}
