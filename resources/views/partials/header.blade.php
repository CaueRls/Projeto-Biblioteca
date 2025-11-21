<div class="header-sticky-wrapper">
        <header class="main-header">
            <div class="container header-container">
                <a href="#" class="logo">
                    <img src="/img/logo.svg" alt="Logo da Livraria">
                </a>

                <form class="search-bar">
                    <input type="text" placeholder="Procurar Livros">
                    <button type="submit" class="search-button">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>

                <div class="user-actions desktop-only">
                    <a href="{{ route('register') }}" aria-label="Minha Conta"><i class="fa-solid fa-user"></i></a>
                    <a href="./favoritos.html" aria-label="Lista de Desejos"><i class="fa-solid fa-heart"></i></a>
                    <a href="./AreaDeCompra.html" aria-label="Carrinho de Compras"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>

                <button class="hamburger-menu" aria-label="Abrir Menu" aria-expanded="false">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </header>

        <nav class="main-nav">
            <div class="container nav-container">
                <ul>
                    <li><a href="">Fantasia</a></li>
                    <li><a href="#">Romance</a></li>
                    <li><a href="#">Terror</a></li>
                    <li><a href="#">Literatura</a></li>
                </ul>

                <div class="user-actions mobile-only">
                    <a href="./TalaDeCadastro.html" aria-label="Minha Conta"><i class="fa-solid fa-user"></i></a>
                    <a href="#" aria-label="Lista de Desejos"><i class="fa-solid fa-heart"></i></a>
                    <a href="./AreaDeCompra.html" aria-label="Carrinho de Compras"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
            </div>
        </nav>

    </div>