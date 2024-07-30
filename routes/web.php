<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

// Redirecionar a rota raiz para a lista de usuários ou para a tela de login
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('usuarios.index');
    } else {
        return redirect()->route('login');
    }
});

// Rotas de autenticação
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::post('login/ajax', [AuthController::class, 'loginAjax'])->name('login.ajax');
Route::get('registro', [AuthController::class, 'showRegistrationForm'])->name('registro');
Route::post('registro', [AuthController::class, 'register'])->name('registro.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {
    Route::resource('usuarios', UsuarioController::class);
    Route::post('enderecos', [EnderecoController::class, 'store'])->name('enderecos.store');
    Route::put('enderecos/{id}', [EnderecoController::class, 'update'])->name('enderecos.update');
    Route::delete('enderecos/{id}', [EnderecoController::class, 'destroy'])->name('enderecos.destroy');
});
?>
