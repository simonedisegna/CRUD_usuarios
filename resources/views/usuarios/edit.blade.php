@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')
<div class="container">
    <h1>Editar Usuário</h1>
    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Dados do Usuário -->
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $usuario->nome }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}" required>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="{{ $usuario->telefone }}">
        </div>
        <div class="form-group">
            <label for="celular">Celular</label>
            <input type="text" class="form-control" id="celular" name="celular" value="{{ $usuario->celular }}">
        </div>
        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $usuario->cpf }}" required>
        </div>

        <!-- Dados de Endereço -->
        <h3>Endereço</h3>
        <div class="form-group">
            <label for="rua">Rua</label>
            <input type="text" class="form-control" id="rua" name="rua" value="{{ $usuario->endereco->rua ?? '' }}">
        </div>
        <div class="form-group">
            <label for="numero">Número</label>
            <input type="text" class="form-control" id="numero" name="numero" value="{{ $usuario->endereco->numero ?? '' }}">
        </div>
        <div class="form-group">
            <label for="bairro">Bairro</label>
            <input type="text" class="form-control" id="bairro" name="bairro" value="{{ $usuario->endereco->bairro ?? '' }}">
        </div>
        <div class="form-group">
            <label for="complemento">Complemento</label>
            <input type="text" class="form-control" id="complemento" name="complemento" value="{{ $usuario->endereco->complemento ?? '' }}">
        </div>
        <div class="form-group">
            <label for="cidade">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" value="{{ $usuario->endereco->cidade ?? '' }}">
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" value="{{ $usuario->endereco->estado ?? '' }}">
        </div>
        <div class="form-group">
            <label for="cep">CEP</label>
            <input type="text" class="form-control" id="cep" name="cep" value="{{ $usuario->endereco->cep ?? '' }}">
        </div>

        <!-- Dados de Login -->
        <h3>Dados de acesso</h3>
        <div class="form-group">
            <label for="nome_login">Nome de Login</label>
            <input type="text" class="form-control" id="nome_login" name="nome_login" value="{{ $usuario->login->nome ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="email_login">Email de Login</label>
            <input type="email" class="form-control" id="email_login" name="email_login" value="{{ $usuario->login->email ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <div class="input-group">
                <input type="password" class="form-control" id="senha" name="senha">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fa fa-eye" id="toggleSenha" style="cursor: pointer;"></i>
                    </span>
                </div>
            </div>
            <small class="form-text text-muted">Deixe em branco se não quiser alterar a senha.</small>
        </div>
        <div class="form-group">
            <label for="senha_confirmation">Confirmar Senha</label>
            <div class="input-group">
                <input type="password" class="form-control" id="senha_confirmation" name="senha_confirmation">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fa fa-eye" id="toggleSenhaConfirmation" style="cursor: pointer;"></i>
                    </span>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
