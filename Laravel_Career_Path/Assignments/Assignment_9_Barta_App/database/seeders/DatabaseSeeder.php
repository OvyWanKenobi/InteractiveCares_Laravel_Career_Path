<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Comment;
use App\Models\Post;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([UserDatabaseSeeder::class]);
        // $this->call([PostDatabaseSeeder::class]);
        $this->call([CommentDatabaseSeeder::class]);


        // User::factory()->create();
        // Post::factory()->create();
        // Comment::factory()->create();
    }
}
