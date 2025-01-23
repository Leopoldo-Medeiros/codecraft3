<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// TODO: Modificar o nome da tabela para 'profiles' no banco de dados
class Profile extends Model
{
    use HasFactory;

    protected $table = 'perfis';  // Especifica o nome correto da tabela
    protected $fillable = ['nome']; // Especifica os campos que podem ser preenchidos
    protected $keyType = 'string'; // Especifica que a chave primária é uma string (UUID)
    public $incrementing = false; // Desativa o auto-incremento

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    // ... resto do código do modelo ...
}
