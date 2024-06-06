@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="auth-wrapper v3">
    <div class="auth-form">
      <div class="card my-5">
        <div class="card-body">
          <a href="#" class="d-flex justify-content-center">
            <img src="{{asset('assets/images/logo-dark.svg"')}}' alt="image" class="img-fluid brand-logo">
          </a>
          <div class="row">
            <div class="d-flex justify-content-center">
              <div class="auth-header">
                <h2 class="text-secondary mt-4"><b>Olá, Bem vindo de volta</b></h2>
                <p class="f-16 mt-2">Insira suas credenciais para continuar</p>
              </div>
            </div>
          </div>
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="username" placeholder="Insira seu username" >
            <label for="email">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="password" placeholder="Insira sua senha" >
            <label for="password">Senha</label>
          </div>
          <div class="d-grid mt-4">
            <button type="button" class="btn btn-secondary" id="login">Login</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
