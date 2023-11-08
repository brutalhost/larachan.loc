<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use DavidBadura\FakerMarkdownGenerator\FakerProvider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find all users with 0 posts
        $users = User::has('posts', '=', 0)->get();

        foreach ($users as $user) {
            $numPosts = rand(1, 4);

            Post::factory()->count($numPosts)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
