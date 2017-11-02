<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class TasksTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testApplication()
    {
        $response = $this->get('/task');
        $response->assertStatus(200);
    }

//    public function testCreateTask()
//    {
////        factory(User::class)->create([
////            'name' => 'Test',
////            'email' => 'test@test.io',
////            'password' => '111111'
////        ]);
//
////        $this->get('/login');
//        $response = $this->post('/task', [
//            'name' => 'Test',
//            'email' => 'test@test.io',
//            'password' => '111111'
//        ]);
//
//        $this->assertDatabaseHas('users', [
//            'email' => 'test@test.io'
//        ]);
//
////        TODO проверить создаётся ли пользователь вообще
////        $response->assertRedirect('/task');
//    }
}
