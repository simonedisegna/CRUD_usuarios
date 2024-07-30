<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Login;

class RegistroTest extends TestCase
{
    use RefreshDatabase;

    public function test_um_usuario_pode_registrar_com_dados_validos()
    {
        $response = $this->post('/register', [
            'nome' => 'Teste',
            'email' => 'teste@example.com',
            'password' => 'SenhaSegura@1',
            'password_confirmation' => 'SenhaSegura@1',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('logins', [
            'email' => 'teste@example.com',
        ]);
    }

    public function test_nome_eh_obrigatorio()
    {
        $response = $this->post('/register', [
            'nome' => '',
            'email' => 'teste@example.com',
            'password' => 'SenhaSegura@1',
            'password_confirmation' => 'SenhaSegura@1',
        ]);

        $response->assertSessionHasErrors(['nome']);
    }

    public function test_email_eh_obrigatorio()
    {
        $response = $this->post('/register', [
            'nome' => 'Teste',
            'email' => '',
            'password' => 'SenhaSegura@1',
            'password_confirmation' => 'SenhaSegura@1',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_senha_eh_obrigatoria()
    {
        $response = $this->post('/register', [
            'nome' => 'Teste',
            'email' => 'teste@example.com',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    public function test_senha_deve_ter_ao_menos_8_caracteres()
    {
        $response = $this->post('/register', [
            'nome' => 'Teste',
            'email' => 'teste@example.com',
            'password' => '1234567',
            'password_confirmation' => '1234567',
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    public function test_senha_deve_conter_uma_letra_maiuscula_uma_minuscula_e_um_numero()
    {
        $response = $this->post('/register', [
            'nome' => 'Teste',
            'email' => 'teste@example.com',
            'password' => 'senha',
            'password_confirmation' => 'senha',
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    public function test_senha_deve_ser_confirmada()
    {
        $response = $this->post('/register', [
            'nome' => 'Teste',
            'email' => 'teste@example.com',
            'password' => 'SenhaSegura@1',
            'password_confirmation' => 'SenhaDiferente@1',
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    public function test_email_deve_ser_valido()
    {
        $response = $this->post('/register', [
            'nome' => 'Teste',
            'email' => 'email-invalido',
            'password' => 'SenhaSegura@1',
            'password_confirmation' => 'SenhaSegura@1',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_email_deve_ser_unico()
    {
        Login::create([
            'nome' => 'Teste',
            'email' => 'teste@example.com',
            'senha' => md5('SenhaSegura@1'),
            'nivel' => 'normal',
        ]);

        $response = $this->post('/register', [
            'nome' => 'OutroTeste',
            'email' => 'teste@example.com',
            'password' => 'SenhaSegura@1',
            'password_confirmation' => 'SenhaSegura@1',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_todos_os_campos_devem_ser_validos()
    {
        $response = $this->post('/register', [
            'nome' => '',
            'email' => 'email-invalido',
            'password' => '123',
            'password_confirmation' => '321',
        ]);

        $response->assertSessionHasErrors(['nome', 'email', 'password']);
    }
}
