<?php

namespace Database\Factories;

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
            'store_id' => 1, // Loja 1 como padrão
            'username' => fake()->unique()->userName(),
            'function' =>  fake()->randomElement(['estoquista', 'costureira', 'gerente']),
            'password' => 123456,
            'role' =>  fake()->randomElement(['admin', 'user']),
            'status' => fake()->boolean(),
            'photo' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified() {}
}
