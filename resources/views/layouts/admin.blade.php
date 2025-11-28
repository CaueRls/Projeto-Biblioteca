<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
</head>
<body class="bg-gray-100 font-sans flex h-screen overflow-hidden">

    <aside class="w-64 bg-[#003B71] text-white flex flex-col">
        <div class="h-20 flex items-center justify-center border-b border-blue-800">
            {{-- Substitua pelo seu logo do Senac se tiver --}}
            <img src="{{ asset('img/logo.svg') }}" alt="Senac" class="h-10">
        </div>

        <nav class="flex-1 px-4 py-6 space-y-4">
            
            {{-- BOTÃO VOLTAR PARA HOME --}}
            <a href="{{ route('home') }}" class="flex items-center gap-4 px-4 py-3 text-blue-200 hover:bg-blue-800 hover:text-white rounded-lg transition border border-blue-800 bg-blue-900/30">
                <i class="fa-solid fa-arrow-left text-xl"></i>
                <span class="font-medium">Voltar ao Site</span>
            </a>

            <div class="border-b border-blue-800 my-4"></div>

            <a href="{{ route('admin.produtos.create') }}" class="flex items-center gap-4 px-4 py-3 text-blue-200 hover:bg-blue-800 hover:text-white rounded-lg transition">
                <i class="fa-solid fa-box-open text-xl"></i>
                <span class="font-medium">Cadastro de Produtos</span>
            </a>

            <a href="{{ route('admin.produtos.index') }}" class="flex items-center gap-4 px-4 py-3 text-blue-200 hover:bg-blue-800 hover:text-white rounded-lg transition">
                <i class="fa-solid fa-pen-to-square text-xl"></i>
                <span>Listar Produtos</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-4 px-4 py-3 text-blue-200 hover:bg-blue-800 hover:text-white rounded-lg transition">
                <i class="fa-solid fa-users text-xl"></i>
                <span>Listar Usuários</span>
            </a>

            <a href="#" class="flex items-center gap-4 px-4 py-3 text-blue-200 hover:bg-blue-800 hover:text-white rounded-lg transition">
                <i class="fa-solid fa-chart-simple text-xl"></i>
                <span>Relatórios</span>
            </a>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col">
        
        <header class="h-20 bg-[#003B71] text-white flex items-center justify-between px-8 shadow-md">
            
            {{-- Título da Página --}}
            <h2 class="text-3xl font-bold w-1/4">@yield('header-title', 'Painel')</h2>
            
            {{-- BARRA DE PESQUISA (CORRIGIDA) --}}
            <div class="flex-1 max-w-lg px-4">
                {{-- AQUI ESTAVA O ERRO: action="#" não funcionava. Agora aponta para a rota correta. --}}
                <form action="{{ route('admin.search') }}" method="GET" class="relative w-full">
                    
                    {{-- O name deve ser 'admin_search' para bater com o Controller --}}
                    <input type="text" 
                           name="admin_search" 
                           placeholder="Pesquisar livros, usuários..." 
                           class="w-full bg-blue-800 text-white placeholder-blue-300 rounded-lg pl-10 pr-12 py-2 focus:outline-none focus:bg-blue-700 transition border border-transparent focus:border-blue-400"
                           value="{{ request('admin_search') }}">
                    
                    <div class="absolute left-0 top-0 mt-2 ml-3 text-blue-300 pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>

                    {{-- Botão de submit explícito --}}
                    <button type="submit" class="absolute right-0 top-0 mt-2 mr-3 text-blue-300 hover:text-white cursor-pointer bg-transparent border-none">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>
            </div>

            {{-- Perfil do Admin --}}
            <div class="flex items-center gap-3 w-1/4 justify-end">
                <div class="text-right">
                    <p class="text-sm font-bold">{{ Auth::user()->name ?? 'Usuário' }}</p>
                    <p class="text-xs text-blue-200">Administrador</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8 bg-white">
            @yield('content')
        </main>
    </div>

</body>
</html>