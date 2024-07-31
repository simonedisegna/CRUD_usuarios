<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateLoginUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_usuario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('login_id');
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();

            $table->foreign('login_id')->references('id')->on('logins')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        });

        // Inserir quatro registros na tabela logins
        DB::table('logins')->insert([
            ['nome' => 'Admin', 'email' => 'admin@example.com', 'senha' => md5('Admin@123'), 'nivel' => 'administrador', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Usuario1', 'email' => 'usuario1@example.com', 'senha' => md5('User@123'), 'nivel' => 'normal', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Usuario2', 'email' => 'usuario2@example.com', 'senha' => md5('User@123'), 'nivel' => 'normal', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Usuario3', 'email' => 'usuario3@example.com', 'senha' => md5('User@123'), 'nivel' => 'normal', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Inserir quatro registros na tabela usuarios
        DB::table('usuarios')->insert([
            ['nome' => 'Usuario1', 'email' => 'usuario1@example.com', 'telefone' => '1111-1111', 'celular' => '99999-9999', 'cpf' => '111.111.111-11'],
            ['nome' => 'Usuario2', 'email' => 'usuario2@example.com', 'telefone' => '2222-2222', 'celular' => '88888-8888', 'cpf' => '222.222.222-22'],
            ['nome' => 'Usuario3', 'email' => 'usuario3@example.com', 'telefone' => '3333-3333', 'celular' => '77777-7777', 'cpf' => '333.333.333-33'],
            ['nome' => 'Admin', 'email' => 'admin@example.com', 'telefone' => '4444-4444', 'celular' => '66666-6666', 'cpf' => '444.444.444-44'],
        ]);

        // Inserir quatro registros na tabela enderecos
        DB::table('enderecos')->insert([
            ['rua' => 'Rua Admin', 'cidade' => 'Cidade Admin', 'estado' => 'Estado Admin', 'cep' => '00000-000', 'usuario_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['rua' => 'Rua Usuario1', 'cidade' => 'Cidade Usuario1', 'estado' => 'Estado Usuario1', 'cep' => '11111-111', 'usuario_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['rua' => 'Rua Usuario2', 'cidade' => 'Cidade Usuario2', 'estado' => 'Estado Usuario2', 'cep' => '22222-222', 'usuario_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['rua' => 'Rua Usuario3', 'cidade' => 'Cidade Usuario3', 'estado' => 'Estado Usuario3', 'cep' => '33333-333', 'usuario_id' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Inserir quatro registros na tabela login_usuario
        DB::table('login_usuario')->insert([
            ['login_id' => 1, 'usuario_id' => 1],
            ['login_id' => 2, 'usuario_id' => 2],
            ['login_id' => 3, 'usuario_id' => 3],
            ['login_id' => 4, 'usuario_id' => 4],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_usuario');
    }
}
