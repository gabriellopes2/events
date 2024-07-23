<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class autenticacaoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @test
     */
    public function usuario_pode_logar()
    {

        $response = $this->withHeaders([
            'Authorization' => 'Basic',
            'username' => 'admin',
            'password' => 'admin'
        ])->postJson('/api/login');

        $response->assertStatus(200); // Verifica se consegue logar
    }
}
