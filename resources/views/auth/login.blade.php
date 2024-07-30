@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <h1>Login</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div id="login-alert" class="alert alert-danger" style="display: none;"></div>
    <form id="loginForm" action="{{ route('login.ajax') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="email" required>
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
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/js/login.js"></script>
@endsection
