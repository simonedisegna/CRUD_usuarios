<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Login;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function um_usuario_pode_fazer_login_com_dados_validos()
    {
        $usuario = Login::create([
            'nome' => 'Teste',
            'email' => 'teste@example.com',
            'senha' => md5('SenhaSegura@1'),
            'nivel' => 'normal',
        ]);

        $response = $this->post('/login', [
            'email' => 'teste@example.com',
            'password' => 'SenhaSegura@1',
        ]);

        $response->assertJson(['success' => true]);
        $this->assertAuthenticatedAs($usuario);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function um_usuario_nao_pode_fazer_login_com_dados_invalidos()
    {
        $usuario = Login::create([
            'nome' => 'Teste',
            'email' => 'teste@example.com',
            'senha' => md5('SenhaSegura@1'),
            'nivel' => 'normal',
        ]);

        $response = $this->post('/login', [
            'email' => 'teste@example.com',
            'password' => 'SenhaErrada@1',
        ]);

        $response->assertJson(['success' => false]);
        $this->assertGuest();
    }
}
