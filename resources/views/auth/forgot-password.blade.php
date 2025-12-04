@extends('layouts.app')

@section('content')

<style>
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

    .auth-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .auth-icon-circle {
        width: 60px;
        height: 60px;
        background-color: #e0f2fe; /* Azul bem claro */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px auto;
    }

    .auth-icon {
        font-size: 1.8rem;
        color: #0284c7; /* Azul */
    }

    .auth-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 10px;
    }

    .auth-subtitle {
        color: #6b7280;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-weight: 700;
        color: #374151;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .form-input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        outline: none;
        font-size: 1rem;
        color: #333;
        transition: all 0.2s;
        background-color: #f9fafb;
    }
    .form-input:focus {
        border-color: #0284c7;
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
    }

    .btn-primary-auth {
        width: 100%;
        background-color: #003B71; /* Azul Senac */
        color: white;
        font-size: 1.1rem;
        font-weight: 700;
        padding: 14px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .btn-primary-auth:hover {
        background-color: #002a52;
        transform: translateY(-1px);
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 25px;
        color: #6b7280;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: color 0.2s;
    }
    .back-link:hover { color: #003B71; }

    /* Alertas */
    .alert-box {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .alert-success {
        background-color: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }
    .alert-error {
        background-color: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

</style>

<div class="auth-page-wrapper">
    <div class="auth-card">
        
        <div class="auth-header">
            <div class="auth-icon-circle">
                <i class="fa-solid fa-key auth-icon"></i>
            </div>
            <h2 class="auth-title">Recuperar Senha</h2>
            <p class="auth-subtitle">
                Informe o seu email e enviaremos um link seguro para redefinir a sua senha.
            </p>
        </div>

        {{-- MENSAGEM DE SUCESSO --}}
        @if (session('status'))
            <div class="alert-box alert-success">
                <i class="fa-solid fa-check-circle"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        {{-- MENSAGENS DE ERRO --}}
        @if ($errors->any())
            <div class="alert-box alert-error">
                <div>
                    <i class="fa-solid fa-circle-exclamation"></i> <strong>Atenção:</strong>
                    <ul style="margin-left: 20px; list-style-type: disc; margin-top: 5px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email registado</label>
                <input id="email" name="email" type="email" autocomplete="email" required autofocus
                    class="form-input"
                    placeholder="ex: seu@email.com"
                    value="{{ old('email') }}">
            </div>

            <button type="submit" class="btn-primary-auth">
                Enviar Link de Redefinição
            </button>
        </form>

        <a href="{{ route('login') }}" class="back-link">
            <i class="fa-solid fa-arrow-left"></i> Voltar para o Login
        </a>

    </div>
</div>
@endsection