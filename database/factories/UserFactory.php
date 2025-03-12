<?php

namespace Database\Factories;

use App\Models\User;
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
            'last_grade' => fake()->numberBetween(1, 5),
            'average' => fake()->randomFloat(2, 1, 5),
            'grade_count' => fake()->numberBetween(1, 5),
        ];
    }

    public function student(): Factory|UserFactory
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('student');
        });
    }

    public function teacher(): Factory|UserFactory
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('teacher');
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
