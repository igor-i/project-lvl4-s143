<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class TasksTest extends TestCase
{

    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testApplication()
    {
        $response = $this->get('/task');
        $response->assertStatus(200);
    }
}
