<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([UserSeeder::class]);
        // $this->call([LinkSeeder::class]);


        User::factory()->create(
            [
                'name' => 'Ashiqur Rahman',
                'email' => 'ashiqur.ovy@gmail.com',
            ]

        )->each(function ($user) {
            $links = Link::factory(5)->create();
            $user->links()->attach($links->pluck('id')->toArray());
        });

        User::factory(4)->create()->each(function ($user) {
            $links = Link::factory(5)->create();
            $user->links()->attach($links->pluck('id')->toArray());
        });
    }
}
