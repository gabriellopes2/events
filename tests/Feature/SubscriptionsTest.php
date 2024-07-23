<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function lista_inscricao()
    {
        $response = $this->get('/api/subscriptions/1');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @test
     */
    public function testa_checkin()
    {
        $response = $this->post('/api/checkin/2');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @test
     */
    public function testa_cancelamento_inscricao()
    {
        $response = $this->post('/api/subscriptions/cancel/2');

        $response->assertStatus(200);
    }

    /** @test */
    public function usuario_nao_pode_se_inscrever_mais_de_uma_vez_no_mesmo_evento()
    {
        $response = $this->post("/api/subscriptions", ['users_id' => 2, 'eventos_id' => 1]);

        $response->assertStatus(409);
    }

    /** @test */
    public function usuario_nao_pode_se_inscrever_em_um_evento_inexistente()
    {

        $response = $this->post('/api/subscriptions', ['users_id' => 3, 'eventos_id' => 9]);

        $response->assertStatus(404);
    }

    /** @test */
    public function nao_pode_cancelar_inscricao_inexistente()
    {

        $response = $this->post("/api/subscriptions/cancel/4");

        $response->assertStatus(404);
    }
}