<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EnderecoController;

// Redirecionar a rota raiz para a lista de usuários
Route::get('/', function () {
    return redirect()->route('usuarios.index');
});

Route::resource('usuarios', UsuarioController::class);
Route::post('enderecos', [EnderecoController::class, 'store'])->name('enderecos.store');
Route::put('enderecos/{id}', [EnderecoController::class, 'update'])->name('enderecos.update');
Route::delete('enderecos/{id}', [EnderecoController::class, 'destroy'])->name('enderecos.destroy');
