<?php

namespace Database\Factories;

use App\Enums\EducationLevel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
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
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => fake()->randomElement(['student', 'instructor', 'donator']),
            'phone_number' => fake()->phoneNumber(),
            'image_url' => fake()->imageUrl(200, 200, 'people'),
            'bio' => fake()->paragraph(),
            'NISN' => fake()->unique()->numerify('##########'),
            'point' => fake()->numberBetween(0, 1000),
            'rating' => fake()->randomFloat(1, 0, 5),
            'education_level' => fake()->randomElement(EducationLevel::cases())->value,
            'major' => fake()->randomElement(['Science', 'Arts', 'Commerce', 'Engineering', 'Medicine']),
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
}
