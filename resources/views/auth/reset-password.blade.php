@extends('layouts.app')

@section('content')

<style>
    /* Reutilizando o estilo auth que já criamos */
    .auth-page-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f3f4f6;
        padding: 40px 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .auth-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        padding: 40px;
        width: 100%;
        max-width: 450px;
        border: 1px solid #e5e7eb;
    }
    .form-input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        outline: none;
        margin-bottom: 15px;
    }
    .btn-primary-auth {
        width: 100%;
        background-color: #003B71;
        color: white;
        padding: 14px;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
    }
</style>

<div class="auth-page-wrapper">
    <div class="auth-card">
        <h2 style="text-align: center; margin-bottom: 20px; font-weight: 800; color: #333;">Nova Senha</h2>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label>Email</label>
                <input class="form-input" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
            </div>

            <div>
                <label>Nova Senha</label>
                <input class="form-input" type="password" name="password" required>
            </div>

            <div>
                <label>Confirmar Nova Senha</label>
                <input class="form-input" type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn-primary-auth">
                Redefinir Senha
            </button>
        </form>
    </div>
</div>
@endsection