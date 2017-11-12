<?php

namespace Tests\Feature;

use App\Status;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;
use App\Tag;
use App\Task;

class TasksTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testApplication()
    {
        $this->get('/tasks')
            ->assertStatus(200);

        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/tasks')
            ->assertStatus(200);
    }

    /**
     * Create task
     *
     * @return void
     */
    public function testCreateTask()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/tasks/create')
            ->assertStatus(200);

        $tags = factory(Tag::class, 2)->create();
        $task = factory(Task::class)->make();

        $this->post("/tasks", [
            'name' => $task->name,
            'description' => $task->description,
            'status_id' => $task->status_id,
            'creator_id' => $task->creator_id,
            'assignedto_id' => $task->assignedto_id,
            'tags_ids' => [
                $tags->first()->id,
                $tags->last()->id,
            ]
        ])->assertRedirect('/tasks/create');

        $this->assertDatabaseHas('tasks', [
            'name' => $task->name,
            'description' => $task->description,
            'status_id' => $task->status_id,
            'creator_id' => $task->creator_id,
            'assignedto_id' => $task->assignedto_id
        ]);

        $this->assertDatabaseHas('tag_task', [
            'tag_id' => $tags->first()->id,
            'task_id' => Task::where('name', $task->name)->first()->id,
        ]);

        $this->assertDatabaseHas('tag_task', [
            'tag_id' => $tags->last()->id,
            'task_id' => Task::where('name', $task->name)->first()->id,
        ]);
    }

    /**
     * Update task
     *
     * @return void
     */
    public function testUpdateTask()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $newTask = factory(Task::class)->make();

        $this->actingAs($user)
            ->get("/tasks/{$task->id}/edit")
            ->assertStatus(200);

        $tags = factory(Tag::class, 2)->create();

        $this->post("/tasks/{$task->id}", [
            'name' => $newTask->name,
            'description' => $newTask->description,
            'status_id' => $newTask->status_id,
            'creator_id' => $task->creator_id,
            'assignedto_id' => $newTask->assignedto_id,
            'tags_ids' => [
                $tags->first()->id,
                $tags->last()->id
            ],
            '_method' => 'PATCH',
            '_token' => csrf_token()
        ])->assertRedirect("/tasks/{$task->id}/edit");

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => $newTask->name,
            'description' => $newTask->description,
            'status_id' => $newTask->status_id,
            'creator_id' => $task->creator_id,
            'assignedto_id' => $newTask->assignedto_id
        ]);

        $this->assertDatabaseHas('tag_task', [
            'tag_id' => $tags->first()->id,
            'task_id' => $task->id
        ]);

        $this->assertDatabaseHas('tag_task', [
            'tag_id' => $tags->last()->id,
            'task_id' => $task->id
        ]);
    }

    /**
     * Delete task
     *
     * @return void
     */
    public function testDeleteTask()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->get("/tasks");

        $tags = factory(Tag::class, 2)->create();
        $task = factory(Task::class)->make();

        $this->post("/tasks", [
            'name' => $task->name,
            'description' => $task->description,
            'status_id' => $task->status_id,
            'creator_id' => $task->creator_id,
            'assignedto_id' => $task->assignedto_id,
            'tags_ids' => [
                $tags->first()->id,
                $tags->last()->id,
            ]
        ]);

        $this->post("/tasks/{$task->id}", [
            '_method' => 'DELETE',
            '_token' => csrf_token()
        ]);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id
        ]);

        $this->assertDatabaseMissing('tag_task', [
            'task_id' => $task->id
        ]);
    }

    /**
     * Filtered tasks by creator
     */
    public function testFilterTaskByCreator()
    {
        $user = factory(User::class)->create();

        factory(Task::class)->create();
        factory(Task::class)->create();

        $response1 = $this->actingAs($user)
            ->get("/tasks")
            ->assertStatus(200);

        $count1 = count($response1->original->getData()['tasks']);
        $this->assertCount(2, $response1->original->getData()['tasks']);

        factory(Task::class)->create(['creator_id' => $user->id]);

        $response2 = $this->actingAs($user)
            ->get("/tasks")
            ->assertStatus(200);

        $this->assertCount($count1 + 1, $response2->original->getData()['tasks']);

        $response3 = $this->actingAs($user)
            ->get("/tasks?creatorid={$user->id}")
            ->assertStatus(200);

        $this->assertCount(1, $response3->original->getData()['tasks']);
    }

    /**
     * Filtered tasks by assignedTo
     */
    public function testFilterTaskByAssignedTo()
    {
        $user = factory(User::class)->create();

        factory(Task::class)->create();
        factory(Task::class)->create();

        $response1 = $this->actingAs($user)
            ->get("/tasks")
            ->assertStatus(200);

        $count1 = count($response1->original->getData()['tasks']);
        $this->assertCount(2, $response1->original->getData()['tasks']);

        factory(Task::class)->create(['assignedto_id' => $user->id]);

        $response2 = $this->actingAs($user)
            ->get("/tasks")
            ->assertStatus(200);

        $this->assertCount($count1 + 1, $response2->original->getData()['tasks']);

        $response3 = $this->actingAs($user)
            ->get("/tasks?assignedtoid={$user->id}")
            ->assertStatus(200);

        $this->assertCount(1, $response3->original->getData()['tasks']);
    }

    /**
     * Filtered tasks by status
     */
    public function testFilterTaskByStatus()
    {
        $user = factory(User::class)->create();

        factory(Task::class)->create();
        factory(Task::class)->create();

        $response1 = $this->actingAs($user)
            ->get("/tasks")
            ->assertStatus(200);

        $count1 = count($response1->original->getData()['tasks']);
        $this->assertCount(2, $response1->original->getData()['tasks']);

        $status = factory(Status::class)->create();

        factory(Task::class)->create(['status_id' => $status->id]);

        $response2 = $this->actingAs($user)
            ->get("/tasks")
            ->assertStatus(200);

        $this->assertCount($count1 + 1, $response2->original->getData()['tasks']);

        $response3 = $this->actingAs($user)
            ->get("/tasks?statusid={$status->id}")
            ->assertStatus(200);

        $this->assertCount(1, $response3->original->getData()['tasks']);
    }

    /**
     * Filtered tasks by tag
     */
    public function testFilterTaskByTag()
    {
        $user = factory(User::class)->create();

        factory(Task::class)->create();
        factory(Task::class)->create();

        $response1 = $this->actingAs($user)
            ->get("/tasks")
            ->assertStatus(200);

        $count1 = count($response1->original->getData()['tasks']);
        $this->assertCount(2, $response1->original->getData()['tasks']);

        $tag = factory(Tag::class)->create();
        $task = factory(Task::class)->make();

        $this->post("/tasks", [
            'name' => $task->name,
            'description' => $task->description,
            'status_id' => $task->status_id,
            'creator_id' => $task->creator_id,
            'assignedto_id' => $task->assignedto_id,
            'tags_ids' => [
                $tag->id
            ]
        ]);

        $response2 = $this->actingAs($user)
            ->get("/tasks")
            ->assertStatus(200);

        $this->assertCount($count1 + 1, $response2->original->getData()['tasks']);

        $response3 = $this->actingAs($user)
            ->get("/tasks?tagid={$tag->id}")
            ->assertStatus(200);

        $this->assertCount(1, $response3->original->getData()['tasks']);
    }
}
