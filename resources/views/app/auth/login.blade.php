@extends('app.layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center login-content">
        <div class="login-wrapper"> 
            <div class="logotipo text-center mb-3">
                <img src="/storage/logotype/logo_tshirt.jpg" alt="logogito-Tshirt">
            </div>
            <div class="auth-content">
                <h4>Olá! Informe suas credenciais para continuar.</h4>
                <form>
                    <div class="mt-3 mb-3">
                        <label for="username" class="form-label">Nome de usuário</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Digite seu nome de usuário">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="********">
                    </div>
                    <div class="btn-wrapper-login">
                        <button type="button" id="login"  class="btn btn-dark w-100">Entrar</button>
                    </div>
                </form>
            </div>          
        </div>
    </div>
@endsection
