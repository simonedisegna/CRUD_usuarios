<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();
            $table->string('cpf')->unique();
            $table->timestamps();
            $table->softDeletes(); // para deleção lógica
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
