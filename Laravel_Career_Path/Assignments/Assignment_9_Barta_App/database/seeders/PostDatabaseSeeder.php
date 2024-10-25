<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        // Post::factory()->create();

        //  
        //     for ($i = 0; $i < 10; $i++) {
        //         DB::table('posts')->insert([

        //             'user_id' => $faker->numberBetween(1, 2),
        //             'content' => $faker->paragraph(5),
        //             'views' => $faker->numberBetween(0, 50),
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]);
        //     }
    }
}
