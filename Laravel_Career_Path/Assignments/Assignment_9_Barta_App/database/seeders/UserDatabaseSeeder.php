<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;


class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */



    public function run(): void
    {

        User::factory()
        ->withAvatar()
            ->has(Post::factory()->count(5))
            ->create([
                'lastname' => 'Rahman',
                'firstname' => 'Ashiqur',
                'username' => 'ovywankenobi',
                'email' => 'ashiqur.ovy@gmail.com',

            ]);

        User::factory(4)
        ->withAvatar()
            ->has(Post::factory()->count(5)) // Create 4 posts for each user
            ->create();


    }
}
