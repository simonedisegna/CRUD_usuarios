@extends('layouts.app')

@section('title', 'Lista de Usuários')

@section('content')
<div class="container">
    <h1>Lista de Usuários</h1>
    <button onclick="teste()" class="btn btn-primary mb-3">Clique aqui</button>
    <a href="{{ route('usuarios.create') }}" class="btn btn-success mb-3">Adicionar Usuário</a>
    <table id="usuariosListagem" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th><input type="text" class="form-control" placeholder="Buscar ID" /></th>
                <th><input type="text" class="form-control" placeholder="Buscar Nome" /></th>
                <th><input type="text" class="form-control" placeholder="Buscar Email" /></th>
                <th></th>
            </tr>
        </tfoot>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->nome }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
