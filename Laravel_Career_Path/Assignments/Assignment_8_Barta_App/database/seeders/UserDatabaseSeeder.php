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
            'lastname' => 'Rahman',
            'firstname' => 'Ashiqur',
            'username' => 'ovywankenobi',
            'email' => 'ashiqur.ovy@gmail.com',
            'password' => Hash::make('123456789'),
            'bio' => 'Hello there , I am a full-stack web developer, a software engineer, a ml enthusiast, a researcher, and most importantly a learner.',

            'created_at' => now(),
        ]);

        DB::table('users')->insert([
            'fullname' => 'John Doe',
            'lastname' => 'Doe',
            'firstname' => 'John',
            'username' => 'johndoe123',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('123456789'),
            'bio' => 'I am John Doe, a backend developer and software architect.',
            'created_at' => now(),
        ]);
    }
}
