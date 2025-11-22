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
            <img src="/img/logo.svg" alt="Senac" class="h-10">            {{-- Ou use texto se não tiver a imagem branca ainda: --}}
            {{-- <h1 class="text-2xl font-bold">SENAC</h1> --}}
        </div>

        <nav class="flex-1 px-4 py-6 space-y-4">
            <a href="{{ route('admin.produtos.create') }}" class="flex items-center gap-4 px-4 py-3 text-blue-200 hover:bg-blue-800 hover:text-white rounded-lg transition">
            <i class="fa-solid fa-box-open text-xl"></i>
            <span class="font-medium">Cadastro de Produtos</span>
        </a>

            <a href="{{ route('admin.produtos.index') }}" class="flex items-center gap-4 px-4 py-3 text-blue-200 hover:bg-blue-800 hover:text-white rounded-lg transition">
                <i class="fa-solid fa-pen-to-square text-xl"></i>
                <span>Listar Produtos</span>
            </a>

            <a href="{{route('admin.users.index')}}" class="flex items-center gap-4 px-4 py-3 text-blue-200 hover:bg-blue-800 hover:text-white rounded-lg transition">
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
            <h2 class="text-3xl font-bold">@yield('header-title', 'Painel')</h2>
            
            <div class="flex items-center gap-3">
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