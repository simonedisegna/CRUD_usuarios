<?php
namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'bairro' => 'required|string|max:255',
            'complemento' => 'nullable|string|max:255',
            'cep' => 'required|string|max:9',
        ]);

        Endereco::create($request->all());

        return redirect()->back()->with('success', 'Endereço adicionado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'bairro' => 'required|string|max:255',
            'complemento' => 'nullable|string|max:255',
            'cep' => 'required|string|max:9',
        ]);

        $endereco = Endereco::findOrFail($id);
        $endereco->update($request->all());

        return redirect()->back()->with('success', 'Endereço atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $endereco = Endereco::findOrFail($id);
        $endereco->delete();

        return redirect()->back()->with('success', 'Endereço excluído com sucesso!');
    }
}
?>
