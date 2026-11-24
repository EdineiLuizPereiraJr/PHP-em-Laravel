<?php

namespace Tests\Feature;

use App\Models\Inscricao;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiEventosTest extends TestCase
{
    use RefreshDatabase;

    public function test_pode_inserir_e_listar_eventos(): void
    {
        $response = $this->postJson('/api/eventos', [
            'nome' => 'Feira de Software',
            'local' => 'Auditório Central',
            'data' => '2026-12-10',
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'nome' => 'Feira de Software',
                'local' => 'Auditório Central',
                'data' => '2026-12-10',
            ]);

        $this->getJson('/api/eventos')
            ->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment(['nome' => 'Feira de Software']);
    }

    public function test_pode_inserir_e_listar_participantes(): void
    {
        $response = $this->postJson('/api/participantes', [
            'nome' => 'Edinei Junior',
            'email' => 'edinei@example.com',
            'telefone' => '(41) 99999-0000',
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'nome' => 'Edinei Junior',
                'email' => 'edinei@example.com',
                'telefone' => '(41) 99999-0000',
            ]);

        $this->getJson('/api/participantes')
            ->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment(['email' => 'edinei@example.com']);
    }

    public function test_retorna_resumo_de_inscricoes(): void
    {
        Inscricao::create([
            'nome_participante' => 'Edinei',
            'evento' => 'Feira de Software',
            'status' => 'confirmada',
        ]);

        Inscricao::create([
            'nome_participante' => 'Yuri',
            'evento' => 'Feira de Software',
            'status' => 'confirmada',
        ]);

        Inscricao::create([
            'nome_participante' => 'Carlos',
            'evento' => 'Feira de Software',
            'status' => 'pendente',
        ]);

        $this->getJson('/api/inscricoes/resumo')
            ->assertStatus(200)
            ->assertExactJson([
                'total_inscricoes' => 3,
                'inscricoes_confirmadas' => 2,
            ]);
    }
}
