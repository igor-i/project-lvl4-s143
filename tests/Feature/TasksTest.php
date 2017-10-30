<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    /**
     * @return void
     */
    public function testApplication()
    {
        $response = $this->get('/tasks');
        $response->assertStatus(200);
    }
}
