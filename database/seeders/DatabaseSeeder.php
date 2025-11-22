<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Necessário para inserir dados

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Criar Usuário Admin
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'is_admin' => true,
            'is_active' => true,
        ]);

        // 2. Criar Gêneros
        $generos = ['Fantasia', 'Ficção Científica', 'Romance', 'Terror', 'Literatura Brasileira', 'Técnico', 'Suspense'];
        foreach ($generos as $nome) {
            DB::table('genres')->insert([
                'name' => $nome,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. Criar Editoras
        $editoras = ['Rocco', 'Companhia das Letras', 'HarperCollins', 'DarkSide', 'Aleph', 'Senac', 'Intrínseca'];
        foreach ($editoras as $nome) {
            DB::table('publishers')->insert([
                'name' => $nome,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 4. Criar Autores
        $autores = ['J.K. Rowling', 'J.R.R. Tolkien', 'Stephen King', 'George R.R. Martin', 'Machado de Assis', 'Agatha Christie'];
        foreach ($autores as $nome) {
            DB::table('authors')->insert([
                'name' => $nome,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}