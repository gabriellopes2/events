<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function lista_eventos()
    {
        $response = $this->get('/api/events');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @test
     */
    public function lista_eventos_usuarios()
    {
        $response = $this->get('/api/events/1');

        $response->assertStatus(200);
    }
}
