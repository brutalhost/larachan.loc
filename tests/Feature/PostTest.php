<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $numberOfPosts = $this->faker->numberBetween(1, 3);

        for ($i = 0; $i < $numberOfPosts; $i++) {
            $post = Post::create([
                'user_id' => $this->user->id,
                'title' => $this->faker->sentence,
                'content' => $this->faker->paragraph,
            ]);
        }

        $numberOfPosts = $this->faker->numberBetween(1, 3);

        for ($i = 0; $i < $numberOfPosts; $i++) {
            $post = Post::create([
                'user_id' => $this->attacker->id,
                'title' => $this->faker->sentence,
                'content' => $this->faker->paragraph,
            ]);
        }
    }

    protected function tearDown(): void
    {
        $this->attacker->posts()->delete();
        $this->user->posts()->delete();
        parent::tearDown();
    }

    /**
     * @test
     */
    public function user_update_delete_another_post(): void
    {
        $this->actingAs($this->attacker);
        $response = $this->get(route('posts.edit', $this->user->posts()->first()))->assertForbidden();
        $response = $this->put(route('posts.update', $this->user->posts()->first()))->assertForbidden();
        $response = $this->delete(route('posts.destroy', $this->user->posts()->first()))->assertForbidden();
    }

    /**
     * @test
     */
    public function guest_update_delete_another_post(): void {
        $response = $this->get(route('posts.edit', $this->user->posts()->first()))->assertForbidden();
        $response = $this->put(route('posts.update', $this->user->posts()->first()))->assertForbidden();
        $response = $this->delete(route('posts.destroy', $this->user->posts()->first()))->assertForbidden();
    }

    /**
     * @test
     */
    public function user_create_foreign_post(): void
    {
        $this->actingAs($this->attacker);
        $response = $this->get(route('posts.store', [
            'user_id' => $this->user->id,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
        ]));
        $this->assertTrue($this->user->posts()->latest()->get()[0]->user_id !== $this->attacker->id,
            'Post was created by the attacker');
    }
}
