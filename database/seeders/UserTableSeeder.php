<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            [
                'id' => (string) Str::uuid(),
                'nome_completo' => 'Admin User',
                'email' => 'admin@email.com',
                'senha' => bcrypt('password'),
                'status' => 'Ativo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
