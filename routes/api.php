<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EnderecoController;

Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('enderecos', EnderecoController::class)->only(['store', 'update', 'destroy']);

?>
