<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Endereco;
use App\Models\Login;
use App\Models\LoginUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with('endereco')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'telefone' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'cpf' => 'required|string|max:14|unique:usuarios',
            'senha' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',

            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'bairro' => 'required|string|max:255',
            'complemento' => 'nullable|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'cep' => 'required|string|max:9',
        ]);

        $usuario = Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'celular' => $request->celular,
            'cpf' => $request->cpf,
            'senha' => md5(trim($request->senha)),
        ]);

        $usuario->endereco()->create([
            'rua' => $request->rua,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'complemento' => $request->complemento,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'cep' => $request->cep,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function show($id)
    {
        $usuario = Usuario::with('endereco')->findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = Usuario::with(['endereco', 'login'])->findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->only('nome', 'email', 'telefone', 'celular', 'cpf'));

        if ($request->filled('senha')) {
            $login = $usuario->login;
            $login->senha = Hash::make($request->senha);
            $login->save();
        }

        $enderecoData = $request->only('rua', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'cep');
        if ($usuario->endereco) {
            $usuario->endereco->update($enderecoData);
        } else {
            $usuario->endereco()->create($enderecoData);
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
