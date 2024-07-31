<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Usuario;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EnderecoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'bairro' => 'required|string|max:255',
            'complemento' => 'nullable|string|max:255',
            'cep' => 'required|string|max:9',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
        ]);

        Endereco::create($request->all());

        return redirect()->back()->with('success', 'Endereço adicionado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email,' . $id,
            'telefone' => 'nullable|string|max:255',
            'celular' => 'nullable|string|max:255',
            'cpf' => 'required|string|max:255|unique:usuarios,cpf,' . $id,
            'senha' => 'nullable|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'bairro' => 'required|string|max:255',
            'complemento' => 'nullable|string|max:255',
            'cep' => 'required|string|max:9',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
        ]);

        // Atualizando os dados do usuário
        $usuario = Usuario::findOrFail($id);
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->telefone = $request->telefone;
        $usuario->celular = $request->celular;
        $usuario->cpf = $request->cpf;
        $usuario->save();

        // Atualizando a senha do login, se fornecida
        if ($request->filled('senha')) {
            $login = Login::where('email', $usuario->email)->first();
            $login->senha = Hash::make(trim($request->senha));
            $login->save();
        }

        // Atualizando ou criando o endereço
        $endereco = Endereco::firstOrNew(['usuario_id' => $usuario->id]);
        $endereco->rua = $request->rua;
        $endereco->numero = $request->numero;
        $endereco->bairro = $request->bairro;
        $endereco->complemento = $request->complemento;
        $endereco->cep = $request->cep;
        $endereco->cidade = $request->cidade;
        $endereco->estado = $request->estado;
        $endereco->save();

        return redirect()->back()->with('success', 'Dados atualizados com sucesso!');
    }

    public function destroy($id)
    {
        $endereco = Endereco::findOrFail($id);
        $endereco->delete();

        return redirect()->back()->with('success', 'Endereço excluído com sucesso!');
    }
}
?>
