<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;
use App\Tag;

class TagsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testApplication()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/tags')
            ->assertStatus(200);
    }

    /**
     * Create tag
     *
     * @return void
     */
    public function testCreateTag()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/tags/create')
            ->assertStatus(200);

        $tag = factory(Tag::class)->make();

        $this->post("/tags", [
            'name' => $tag->name,
            'color' => $tag->color
        ])->assertRedirect('/tags/create');

        $this->assertDatabaseHas('tags', [
            'name' => $tag->name,
            'color' => $tag->color
        ]);
    }

    /**
     * Update tag
     *
     * @return void
     */
    public function testUpdateTag()
    {
        $user = factory(User::class)->create();
        $tag = factory(Tag::class)->create();
        $newTag = factory(Tag::class)->make();

        $this->actingAs($user)
            ->get("/tags/{$tag->id}/edit")
            ->assertStatus(200);

        $this->post("/tags/{$tag->id}", [
            'name' => $newTag->name,
            '_method' => 'PATCH',
            '_token' => csrf_token()
        ])->assertRedirect("/tags/{$tag->id}/edit");

        $this->assertDatabaseHas('tags', [
            'name' => $newTag->name
        ]);
    }

    /**
     * Delete tag
     *
     * @return void
     */
    public function testDeleteTag()
    {
        $user = factory(User::class)->create();
        $tag = factory(Tag::class)->create();

        $this->actingAs($user)
            ->get("/tags/{$tag->id}/edit")
            ->assertStatus(200);

        $this->post("/tags/{$tag->id}", [
            '_method' => 'DELETE',
            '_token' => csrf_token()
        ]);

        $this->assertDatabaseMissing('tags', [
            'id' => $tag->id
        ]);
    }

    /**
     * Filtered tag
     */
    public function testFilterTag()
    {
        $user = factory(User::class)->create();

        $response1 = $this->actingAs($user)
            ->get("/tags?name=test")
            ->assertViewHas('tags');

        $this->assertCount(0, $response1->original->getData()['tags']);

        factory(Tag::class)->create(['name' => 'test']);
        factory(Tag::class)->create(['name' => 'onemoretest']);
        factory(Tag::class)->create(['name' => 'someelse']);

        $response2 = $this->actingAs($user)
            ->get("/tags?name=test")
            ->assertViewHas('tags');

        $this->assertCount(2, $response2->original->getData()['tags']);
    }
}
