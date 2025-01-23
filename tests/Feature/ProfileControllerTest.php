<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Profile;
use App\Models\User;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testCreateProfile()
    {
        // Cria um usuário e autentica
        $user = User::factory()->create();
        $this->actingAs($user);

        // Dados do perfil a serem criados
        $profileData = [
            'nome' => $this->faker->name,
        ];

        // Faz a requisição para criar o perfil
        $response = $this->postJson('/api/profiles', $profileData);

        // Verifica se a resposta está correta
        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'nome',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function testListProfiles()
    {
        // Cria um usuário e autentica
        $user = User::factory()->create();
        $this->actingAs($user);

        // Cria 5 perfis
        Profile::factory()->count(5)->create();

        // Faz a requisição para listar os perfis
        $response = $this->getJson('/api/profiles');

        // Verifica se a resposta está correta
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'nome',
                        'created_at',
                        'updated_at'
                    ]
                ],
                'meta' => [ // Inclui meta se for retornado pelo controlador
                    'current_page',
                    'last_page',
                    'per_page',
                    'total',
                ]
            ]);
    }
}
