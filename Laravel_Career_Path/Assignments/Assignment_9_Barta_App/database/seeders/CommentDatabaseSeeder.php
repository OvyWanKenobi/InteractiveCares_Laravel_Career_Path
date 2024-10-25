<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

class CommentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $posts = Post::all();


        Comment::factory(40)
        ->create(function () use ($users, $posts) {
            return [
                'user_id' => $users->random()->id, 
                'post_id' => $posts->random()->id,  
            ];
        });
    }
}
