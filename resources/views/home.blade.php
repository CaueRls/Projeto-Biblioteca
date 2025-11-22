{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')
    <main>
        
        {{-- HERO CAROUSEL (Mantive estático pois são banners promocionais) --}}
        <section class="hero-carousel">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">

                    {{-- SE NÃO TIVER DESTAQUE, MOSTRA UM AVISO OU SLIDE PADRÃO --}}
                    @if($destaques->isEmpty())
                         <div class="swiper-slide">
                            <div class="container">
                                <h2 style="color: white; text-align: center; padding-top: 50px;">Nenhum destaque cadastrado</h2>
                            </div>
                         </div>
                    @else
                        {{-- LOOP DOS DESTAQUES --}}
                        @foreach($destaques as $destaque)
                        <div class="swiper-slide">
                            <div class="container">
                                <div class="carousel-slide">
                                    <div class="slide-content">
                                        {{-- Título do Livro --}}
                                        <h2 class="slide-title">{{ $destaque->titulo }}</h2>
                                        
                                        {{-- Descrição (Autor e Editora) --}}
                                        <p class="slide-description">
                                            Aproveite esta obra incrível de {{ $destaque->author->name }} 
                                            lançada pela editora {{ $destaque->publisher->name }}.
                                        </p>
                                        
                                        {{-- Preço no Botão --}}
                                        <a href="#" class="btn btn-primary">
                                            Comprar por R$ {{ number_format($destaque->preco, 2, ',', '.') }}
                                        </a>
                                    </div>
                                    
                                    {{-- Imagem do Livro --}}
                                    <div class="slide-image">
                                        <img src="{{ $destaque->imagem }}" alt="{{ $destaque->titulo }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif

                </div>
                
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </section>

        {{-- SEÇÃO: BEST SELLERS (Agora Dinâmica) --}}
        <section class="book-section">
            <div class="container">
                <h2 class="section-title">Best Seller</h2>

                <div class="book-slider">
                    <button class="arrow-button left-arrow"><i class="fa-solid fa-chevron-left"></i></button>

                    <div class="slider-wrapper">
                        
                        {{-- VERIFICA SE TEM LIVROS --}}
                        @if($livros->isEmpty())
                            <p style="padding: 20px; color: gray;">Nenhum livro cadastrado.</p>
                        @else
                            {{-- LOOP DOS LIVROS --}}
                            @foreach($livros as $livro)
                                <div class="book-card">
                                    {{-- Imagem do Banco --}}
                                    <img src="{{ $livro->imagem }}" alt="{{ $livro->titulo }}" class="book-cover">
                                    
                                    {{-- Título do Banco --}}
                                    <h3 class="book-title">{{ $livro->titulo }}</h3>
                                    
                                    {{-- Descrição (Como não temos sinopse no banco, pus Autor e Gênero) --}}
                                    <p class="book-description">
                                        <strong>Autor:</strong> {{ $livro->author->name }} <br>
                                        <strong>Gênero:</strong> {{ $livro->genre->name }}
                                    </p>
                                    
                                    {{-- Preço --}}
                                    <div class="book-price">
                                        R$ {{ number_format($livro->preco, 2, ',', '.') }}
                                    </div>
                                    
                                    <button class="btn btn-primary">Comprar</button>
                                </div>
                            @endforeach
                        @endif

                    </div>

                    <button class="arrow-button right-arrow"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </section>

        {{-- SEÇÃO: CATEGORIA (Repetimos a lógica ou filtramos depois) --}}
        <section class="book-section">
            <div class="container">
                <h2 class="section-title">Destaques da Loja</h2>

                <div class="book-slider">
                    <button class="arrow-button left-arrow"><i class="fa-solid fa-chevron-left"></i></button>

                    <div class="slider-wrapper">
                        
                        @foreach($livros as $livro)
                            <div class="book-card">
                                <img src="{{ $livro->imagem }}" alt="{{ $livro->titulo }}" class="book-cover">
                                <h3 class="book-title">{{ $livro->titulo }}</h3>
                                <p class="book-description">
                                    {{ $livro->publisher->name }}
                                </p>
                                <div class="book-price">
                                    R$ {{ number_format($livro->preco, 2, ',', '.') }}
                                </div>
                                <button class="btn btn-primary">Comprar</button>
                            </div>
                        @endforeach

                    </div>

                    <button class="arrow-button right-arrow"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </section>

    </main>
@endsection