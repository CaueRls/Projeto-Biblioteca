@extends('layouts.app') {{-- Assumindo que você usa um layout principal --}}

@section('title', 'Redefina sua Senha - SENAC Livraria')

{{-- O Laravel normalmente cuida das tags de cabeçalho (CSS, etc.) no seu layout principal. --}}
{{-- Seus links para 'css/style.css', Font Awesome e Tailwind CSS provavelmente --}}
{{-- devem ser incluídos no arquivo 'layouts/app.blade.php' ou similar. --}}

@section('content')
<main class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8 space-y-6">

        <div>
            <h2 class="text-center text-3xl font-extrabold text-gray-900">
                Esqueceu sua Senha?
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Informe seu e-mail para receber um link de redefinição.
            </p>
        </div>

        {{-- Exibição de Mensagens de Sessão (Sucesso/Erro) --}}
        @if (session('status'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        {{-- Formulário de Envio de Link --}}
        <form class="space-y-6" method="POST" action="{{ route('password.email') }}">
            @csrf {{-- Diretiva obrigatória de proteção contra CSRF do Laravel --}}
            
            <div>
                <label for="email-address" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input id="email-address" name="email" type="email" autocomplete="email" required 
                        value="{{ old('email') }}"
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                
                {{-- Exibe erro de validação (se houver) --}}
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                    Enviar Link de Redefinição
                </button>
            </div>
        </form>

        <div class="text-center">
            <p class="text-sm text-gray-600">
                Lembrou sua senha?
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500 hover:underline">
                    Faça login
                </a>
            </p>
        </div>
    </div>
</main>
@endsection