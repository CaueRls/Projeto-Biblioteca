@extends('layouts.app')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<main class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-100">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8 space-y-6">
        
        <div>
            <h2 class="text-center text-3xl font-extrabold text-gray-900">
                Acesse sua Conta
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Bem-vindo de volta!
            </p>
        </div>

        {{-- Exibir mensagens de erro (ex: senha errada) --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="space-y-6" action="{{ route('login.submit') }}" method="POST">
            @csrf

            {{-- E-mail --}}
            <div>
                <label for="email-address" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input id="email-address" name="email" type="email" autocomplete="email" required 
                    value="{{ old('email') }}"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Senha --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required 
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                        Lembrar de mim
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                        Esqueceu a senha?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                    Entrar
                </button>
            </div>
        </form>

        <div class="text-center">
            <p class="text-sm text-gray-600">
                Ainda não tem conta?
                <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500 hover:underline">
                    Cadastre-se
                </a>
            </p>
        </div>
    </div>
</main>
@endsection