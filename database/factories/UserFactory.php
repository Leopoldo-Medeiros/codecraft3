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
    // Em database/factories/UserFactory.php
    public function definition(): array
    {
        return [
            'nome_completo' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'senha' => bcrypt('password'),
            'telefone' => fake()->phoneNumber(),
            'imagem_perfil' => null,
            'token_recuperacao' => null,
            'token_expiracao' => null,
            '2FA' => 0,
            'status' => 'Ativo',
        ];
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
