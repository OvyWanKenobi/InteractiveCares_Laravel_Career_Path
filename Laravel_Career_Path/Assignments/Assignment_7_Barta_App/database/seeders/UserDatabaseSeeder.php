<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */



    public function run(): void
    {

        $faker = Factory::create();


        DB::table('users')->insert([

            'fullname' => 'Ashiqur Rahman',
            'lastname' => 'Ashiqur',
            'firstname' => 'Rahman',
            'username' => 'ovywankenobi',
            'email' => 'ashiqur.ovy@gmail.com',

            // 'fullname' => $faker->name,
            // 'lastname' => $faker->lastName,
            // 'firstname' => $faker->firstName,
            // 'username' => $faker->userName,
            // 'email' => $faker->email,

            'password' => Hash::make('123456789'),
            'bio' => 'Hello there , I am a full-stack web developer, a software engineer, a ml enthusiast, a researcher, and most importantly a learner.',
            'created_at' => now(),
        ]);
    }
}
