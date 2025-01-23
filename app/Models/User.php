<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'nome_completo',
        'email',
        'password', // Ensure this matches your migration
        'telefone',
        'imagem_perfil',
        'token_recuperacao',
        'token_expiracao',
        'autenticacao_dois_fatores',
        'status',
    ];

    protected $hidden = [
        'password', // Ensure this matches the field name in the fillable array
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime', // Correctly define casts
    ];
}
