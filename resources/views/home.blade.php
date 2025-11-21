{{-- resources/views/home.blade.php --}}

{{-- Dizemos que esta página usa o layout 'app' --}}
@extends('layouts.app')

{{-- Tudo aqui dentro vai ser injetado no lugar do @yield('content') --}}
@section('content')
    
    

    <main>
        <section class="hero-carousel">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="container">
                            <div class="carousel-slide">
                                <div class="slide-content">
                                    <h2 class="slide-title">Lançamento do Mês</h2>
                                    <p class="slide-description">Descubra uma nova aventura épica que vai prender você
                                        do começo ao fim.</p>
                                    <a href="./telaDeProduto.html" class="btn btn-primary">Ver Detalhes</a>
                                </div>
                                <div class="slide-image">
                                    <img src="https://m.media-amazon.com/images/I/81MoknVer8L._SY466_.jpg"
                                        alt="Livro em destaque no carrossel">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="container">
                            <div class="carousel-slide">
                                <div class="slide-content">
                                    <h2 class="slide-title">Promoção Imperdível</h2>
                                    <p class="slide-description">O clássico que você ama com um preço que você não vai
                                        acreditar. Apenas esta semana!</p>
                                    <a href="#" class="btn btn-primary">Aproveitar</a>
                                </div>
                                <div class="slide-image">
                                    <img src="https://m.media-amazon.com/images/I/511+-lOOtsL._SY445_SX342_ControlCacheEqualizer_.jpg"
                                        alt="Livro em destaque no carrossel">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <section class="book-section">
            <div class="container">
                <h2 class="section-title">Best Seller</h2>

                <div class="book-slider">
                    <button class="arrow-button left-arrow"><i class="fa-solid fa-chevron-left"></i></button>

                    <div class="slider-wrapper">
                        <div class="book-card">
                            <img src="https://m.media-amazon.com/images/I/81MoknVer8L._SY466_.jpg" alt="Capa do Livro"
                                class="book-cover">
                            <h3 class="book-title">Smarilion</h3>
                            <p class="book-description">O Silmarillion" é a coleção de mitos de J.R.R. Tolkien sobre a
                                criação do mundo, as lendas dos Elfos e a guerra contra o primeiro Senhor do Escuro,
                                Morgoth, antes dos eventos de "O Senhor dos Anéis"
                            </p>
                            <div class="book-price">
                                <span class="old-price">R$ 69,90</span>
                                R$ 49,90
                            </div>
                            <button class="btn btn-primary">Comprar</button>
                        </div>

                        <div class="book-card">
                            <img src="https://m.media-amazon.com/images/I/81MoknVer8L._SY466_.jpg" alt="Capa do Livro"
                                class="book-cover">
                            <h3 class="book-title">Smarilion</h3>
                            <p class="book-description">O Silmarillion" é a coleção de mitos de J.R.R. Tolkien sobre a
                                criação do mundo, as lendas dos Elfos e a guerra contra o primeiro Senhor do Escuro,
                                Morgoth, antes dos eventos de "O Senhor dos Anéis"
                            </p>
                            <div class="book-price">
                                <span class="old-price">R$ 69,90</span>
                                R$ 49,90
                            </div>
                            <button class="btn btn-primary">Comprar</button>
                        </div>

                        <div class="book-card">
                            <img src="https://m.media-amazon.com/images/I/81MoknVer8L._SY466_.jpg" alt="Capa do Livro"
                                class="book-cover">
                            <h3 class="book-title">Smarilion</h3>
                            <p class="book-description">O Silmarillion" é a coleção de mitos de J.R.R. Tolkien sobre a
                                criação do mundo, as lendas dos Elfos e a guerra contra o primeiro Senhor do Escuro,
                                Morgoth, antes dos eventos de "O Senhor dos Anéis"
                            </p>
                            <div class="book-price">
                                <span class="old-price">R$ 69,90</span>
                                R$ 49,90
                            </div>
                            <button class="btn btn-primary">Comprar</button>
                        </div>
                    </div>

                    <button class="arrow-button right-arrow"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </section>

        <section class="book-section">
            <div class="container">
                <h2 class="section-title">Categoria</h2>

                <div class="book-slider">
                    <button class="arrow-button left-arrow"><i class="fa-solid fa-chevron-left"></i></button>

                    <div class="slider-wrapper">
                        <div class="book-card">
                            <img src="https://m.media-amazon.com/images/I/81MoknVer8L._SY466_.jpg" alt="Capa do Livro"
                                class="book-cover">
                            <h3 class="book-title">Smarilion</h3>
                            <p class="book-description">O Silmarillion" é a coleção de mitos de J.R.R. Tolkien sobre a
                                criação do mundo, as lendas dos Elfos e a guerra contra o primeiro Senhor do Escuro,
                                Morgoth, antes dos eventos de "O Senhor dos Anéis"
                            </p>
                            <div class="book-price">
                                <span class="old-price">R$ 69,90</span>
                                R$ 49,90
                            </div>
                            <button class="btn btn-primary">Comprar</button>
                        </div>

                        <div class="book-card">
                            <img src="https://m.media-amazon.com/images/I/81MoknVer8L._SY466_.jpg" alt="Capa do Livro"
                                class="book-cover">
                            <h3 class="book-title">Smarilion</h3>
                            <p class="book-description">O Silmarillion" é a coleção de mitos de J.R.R. Tolkien sobre a
                                criação do mundo, as lendas dos Elfos e a guerra contra o primeiro Senhor do Escuro,
                                Morgoth, antes dos eventos de "O Senhor dos Anéis"
                            </p>
                            <div class="book-price">
                                <span class="old-price">R$ 69,90</span>
                                R$ 49,90
                            </div>
                            <button class="btn btn-primary">Comprar</button>
                        </div>

                        <div class="book-card">
                            <img src="https://m.media-amazon.com/images/I/81MoknVer8L._SY466_.jpg" alt="Capa do Livro"
                                class="book-cover">
                            <h3 class="book-title">Smarilion</h3>
                            <p class="book-description">O Silmarillion" é a coleção de mitos de J.R.R. Tolkien sobre a
                                criação do mundo, as lendas dos Elfos e a guerra contra o primeiro Senhor do Escuro,
                                Morgoth, antes dos eventos de "O Senhor dos Anéis"
                            </p>
                            <div class="book-price">
                                <span class="old-price">R$ 69,90</span>
                                R$ 49,90
                            </div>
                            <button class="btn btn-primary">Comprar</button>
                        </div>
                    </div>

                    <button class="arrow-button right-arrow"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </section>

@endsection