@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<div class="container">
    <h1>Registro</h1>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form id="registroForm" action="{{ route('registro.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" class="form-control" id="nome" required>
            <div class="invalid-feedback" id="nomeFeedback"></div>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="email" required>
            <div class="invalid-feedback" id="emailFeedback"></div>
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <div class="input-group">
                <input type="password" name="password" class="form-control" id="password" required>
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                    </span>
                </div>
            </div>
            <div class="invalid-feedback" id="passwordFeedback"></div>
            <small id="passwordHelp" class="form-text text-muted">
                A senha deve ter pelo menos 8 caracteres, uma letra maiúscula, uma letra minúscula e um dígito.
            </small>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirme a Senha:</label>
            <div class="input-group">
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fa fa-eye" id="togglePasswordConfirmation" style="cursor: pointer;"></i>
                    </span>
                </div>
            </div>
            <div class="invalid-feedback" id="passwordConfirmationFeedback"></div>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/js/registro.js"></script>
@endsection
