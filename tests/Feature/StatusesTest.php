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
            ->get('/statuses')
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
            ->get('/statuses/create')
            ->assertStatus(200);

        $status = factory(Status::class)->make();

        $this->post("/statuses", [
            'name' => $status->name,
        ])->assertRedirect('/statuses/create');

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
            ->get("/statuses/{$status->id}/edit")
            ->assertStatus(200);

        $this->post("/statuses/{$status->id}", [
            'name' => $newStatus->name,
            '_method' => 'PATCH',
            '_token' => csrf_token()
        ])->assertRedirect("/statuses/{$status->id}/edit");

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
            ->get("/statuses/{$status->id}/edit")
            ->assertStatus(200);

        $this->post("/statuses/{$status->id}", [
            '_method' => 'DELETE',
            '_token' => csrf_token()
        ]);

        $this->assertDatabaseMissing('TaskStatuses', [
            'id' => $status->id
        ]);
    }

    /**
     * Filtered status
     */
    public function testFilterStatus()
    {
        $user = factory(User::class)->create();

        $response1 = $this->actingAs($user)
            ->get("/statuses?name=todo")
            ->assertViewHas('statuses');

        $count1 = count($response1->original->getData()['statuses']);

        factory(Status::class)->create(['name' => 'someonetodo']);

        $response2 = $this->actingAs($user)
            ->get("/statuses?name=todo")
            ->assertViewHas('statuses');

        $this->assertCount($count1 + 1, $response2->original->getData()['statuses']);
    }
}
