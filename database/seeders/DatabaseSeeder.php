<?php

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Endereco;
use App\Models\Login;
use App\Models\LoginUsuario;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $usuario = Usuario::create([
            'nome' => 'Test User',
            'email' => 'test@example.com',
            'telefone' => '1234567890',
            'celular' => '0987654321',
            'cpf' => '123.456.789-00',
        ]);

        $usuario->endereco()->create([
            'rua' => 'Test Street',
            'numero' => '123',
            'complemento' => 'Apt 1',
            'bairro' => 'Test Neighborhood',
            'cidade' => 'Test City',
            'estado' => 'TS',
            'cep' => '12345-678',
        ]);

        $login = Login::create([
            'nome' => 'testlogin',
            'email' => 'login@example.com',
            'senha' => bcrypt('password'),
            'nivel' => 'normal',
        ]);

        LoginUsuario::create([
            'login_id' => $login->id,
            'usuario_id' => $usuario->id,
        ]);
    }
}
