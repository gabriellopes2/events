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
            'username' => 'teste8',
            'password' => 'teste123'
        ];

        $response = $this->post('/api/users', $userData);


        $response->assertStatus(200);

        // $this->assertDatabaseHas('users', [
        //     'name' => 'John Doe',
        //     'username' => 'johndoe',
        // ]);
    }

     /** @test */
     public function nome_deve_ter_um_comprimento_maximo_de_255_caracteres()
     {
         $response = $this->post('/api/users', [
             'name' => str_repeat('a', 256),
             'username' => 'uniqueuser',
             'password' => 'password123',
         ]);
 
         $response->assertSessionHasErrors('name');
     }

    /** @test */
    public function username_deve_ter_um_comprimento_maximo_de_255_caracteres()
    {
        $response = $this->post('/api/users', [
            'name' => 'Jane Doe',
            'username' => str_repeat('a', 256),
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('username');
    }

    /** @test */
    public function todos_os_campos_obrigatorios_devem_estar_presentes()
    {
        $response = $this->post('/api/users', []);

        $response->assertSessionHasErrors(['name', 'username', 'password']);
    }

    /** @test */
    public function nome_deve_ser_obrigatorio()
    {
        $response = $this->post('/api/users', [
            'username' => 'uniqueuser',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function username_deve_ser_unico()
    {

        $response = $this->post('/api/users', [
            'name' => 'Jane Doe',
            'username' => 'admin', // Nome de usuário duplicado
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('username');
    }
}
