<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

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
    }
}
