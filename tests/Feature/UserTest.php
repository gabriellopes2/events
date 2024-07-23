<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function userCreate()
    {
        $userData = [
            'name' => 'Teste',
            'username' => 'teste',
            'password' => 'teste123'
        ];

        $response = $this->post('/api/users', $userData);


        $response->assertStatus(200);

        // $this->assertDatabaseHas('users', [
        //     'name' => 'John Doe',
        //     'username' => 'johndoe',
        // ]);
    }

    /**
     * A basic test example.
     *
     * @test
     */
    /*public function campos_obrigatorios_sao_validados()
    {
        $response = $this->post('/api/users', []);

        $response->assertSessionHasErrors(['username', 'password']);
    }*/

    /**
     * A basic test example.
     *
     * @test
     */
    public function nome_de_usuario_deve_ser_unico()
    {
        $newUserData = [
            'name' => 'Jane Doe',
            'username' => 'admin2', // username duplicado
            'password' => 'password123',
        ];

        $response = $this->post('/api/users', $newUserData);

        $response->assertSessionHasErrors('username');
    }
}
