<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('perfis')->insert([
            ['id' => (string) Str::uuid(), 'nome' => 'Administrador', 'descricao' => 'Perfil de administrador', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
