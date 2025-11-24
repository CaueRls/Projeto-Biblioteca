<div class="header-sticky-wrapper">
    <header class="main-header">
        <div class="container header-container">
            <a href="{{ url('/') }}" class="logo">
                <img src="/img/logo.svg" alt="Logo da Livraria">
            </a>

            {{-- A rota aponta para 'home' e o método é GET --}}
            <form action="{{ route('home') }}" method="GET" class="search-bar">

                {{-- O name="search" é o que o Controller vai ler ($request->search) --}}
                {{-- value="{{ request('search') }}" mantém o texto escrito após pesquisar --}}
                <input type="text" name="search" placeholder="Procurar Livros, Autores..."
                    value="{{ request('search') }}">

                <button type="submit" class="search-button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>

            {{-- DESKTOP --}}
            <div class="user-actions desktop-only">
                {{-- Se for ADMIN, mostra o botão de Painel --}}
                @if(Auth::user()?->is_admin)
                <a href="{{ route('admin.produtos.index') }}"
                    style="background: transparent; border: none; padding: 0; cursor: pointer; color: #ffph7f00; font-size: 24px; display: inline-block; vertical-align: middle;"
                    title="Painel Admin">
                    <i class="fa-solid fa-gear"></i>
                </a>
                @endif

                {{-- Visitante: Vê ícone de usuário (vai para login) --}}
                @guest
                <a href="{{ route('register') }}" aria-label="Minha Conta"><i class="fa-solid fa-user"></i></a>
                @endguest

                {{-- Logado: Vê Favoritos, Carrinho e Sair --}}
                @auth
                {{-- Ícones normais --}}
                <a href="#" aria-label="Lista de Desejos"><i class="fa-solid fa-heart"></i></a>
                <a href="{{ route('cart.index') }}" aria-label="Carrinho de Compras" class="relative">
                    <i class="fa-solid fa-cart-shopping"></i>

                    {{-- Contagem (Só mostra se tiver itens) --}}
                    @if(session('cart'))
                    <span
                        class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                        {{ count(session('cart')) }}
                    </span>
                    @endif
                </a>

                {{-- Botão de Sair --}}
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    {{-- MUDANÇA: Adicionei 'color: #fff' e 'font-size: 18px' para igualar --}}
                    <button type="submit" aria-label="Sair"
                        style="background: transparent; border: none; padding: 0; cursor: pointer; color: #f39c12; font-size: 24px; display: inline-block; vertical-align: middle;">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
                @endauth

            </div>

            <button class="hamburger-menu" aria-label="Abrir Menu" aria-expanded="false">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </header>

    <nav class="main-nav">
        <div class="container nav-container">
            <ul>
                <li><a href="#">Fantasia</a></li>
                <li><a href="#">Romance</a></li>
                <li><a href="#">Terror</a></li>
                <li><a href="#">Literatura</a></li>
            </ul>

            {{-- MOBILE --}}
            <div class="user-actions mobile-only">

                @guest
                <a href="{{ route('login') }}" aria-label="Minha Conta"><i class="fa-solid fa-user"></i></a>
                @endguest

                @auth
                <a href="#" aria-label="Lista de Desejos"><i class="fa-solid fa-heart"></i></a>
                <a href="#" aria-label="Carrinho de Compras"><i class="fa-solid fa-cart-shopping"></i></a>

                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" aria-label="Sair"
                        style="background: none; border: none; padding: 0; color: inherit; font-size: inherit; cursor: pointer;">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
                @endauth

            </div>
        </div>
    </nav>
</div>