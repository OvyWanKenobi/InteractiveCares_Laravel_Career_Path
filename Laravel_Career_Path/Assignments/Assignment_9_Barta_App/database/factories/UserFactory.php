<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('123456789'),
            'bio' => $this->faker->sentence(5),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }


    public function withAvatar()
    {
        return $this->afterCreating(function (User $user) {
            $url = "https://ui-avatars.com/api/?background=random&name=" . urlencode($user->fullname);
            $contents = Http::get($url)->body();
            $filename = $user->username . '.png';
            Storage::disk('local')->put('profile-picture/' . $filename, $contents);
            $user->update(['profilepicture' => $filename]);
        });
    }
}
