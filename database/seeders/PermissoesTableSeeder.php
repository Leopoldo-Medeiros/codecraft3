<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('permissoes')->insert([
            ['id' => (string) Str::uuid(), 'nome' => 'Visualizar Relatórios', 'descricao' => 'Permissão para visualizar relatórios', 'status' => 'Ativo', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
