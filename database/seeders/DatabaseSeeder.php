<?php

namespace Database\Seeders;

use App\Models\Evento;
use App\Models\Inscricao;
use App\Models\Participante;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Evento::create([
            'nome' => 'Semana de Tecnologia',
            'local' => 'Auditório Principal',
            'data' => '2026-11-24',
        ]);

        Evento::create([
            'nome' => 'Workshop de Laravel',
            'local' => 'Laboratório 02',
            'data' => '2026-12-05',
        ]);

        Participante::create([
            'nome' => 'Edinei Luiz Pereira Junior',
            'email' => 'edinei@example.com',
            'telefone' => '(41) 99999-1111',
        ]);

        Participante::create([
            'nome' => 'Yuri Gabriel dos Santos Pereira',
            'email' => 'yuri@example.com',
            'telefone' => '(41) 99999-2222',
        ]);

        Inscricao::insert([
            [
                'nome_participante' => 'Edinei Luiz Pereira Junior',
                'evento' => 'Semana de Tecnologia',
                'status' => 'confirmada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome_participante' => 'Yuri Gabriel dos Santos Pereira',
                'evento' => 'Semana de Tecnologia',
                'status' => 'confirmada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome_participante' => 'Maria Silva',
                'evento' => 'Workshop de Laravel',
                'status' => 'confirmada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome_participante' => 'João Santos',
                'evento' => 'Workshop de Laravel',
                'status' => 'pendente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome_participante' => 'Ana Oliveira',
                'evento' => 'Semana de Tecnologia',
                'status' => 'cancelada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
