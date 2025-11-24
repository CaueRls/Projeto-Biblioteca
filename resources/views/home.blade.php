{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')
    <main>
        
        {{-- =================================================
             HERO CAROUSEL (SWIPER)
             ================================================= --}}
        <section class="hero-carousel">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">

                    @if($destaques->isEmpty())
                         <div class="swiper-slide">
                            <div class="container">
                                <div class="carousel-slide" style="justify-content: center;">
                                    <h2 style="color: white; text-align: center; padding: 50px;">
                                        Nenhum destaque cadastrado.
                                    </h2>
                                </div>
                            </div>
                         </div>
                    @else
                        @foreach($destaques as $destaque)
                        <div class="swiper-slide">
                            <div class="container">
                                <div class="carousel-slide">
                                    <div class="slide-content">
                                        <h2 class="slide-title">{{ $destaque->titulo }}</h2>
                                        
                                        <p class="slide-description">
                                            Uma obra incrível de {{ $destaque->author->name }}, 
                                            lançada pela editora {{ $destaque->publisher->name }}.
                                        </p>
                                        
                                        {{-- Botão do Banner (Leva para detalhes ou adiciona ao carrinho) --}}
                                        <form action="{{ route('cart.add', $destaque->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">
                                                Comprar por R$ {{ number_format($destaque->preco, 2, ',', '.') }}
                                            </button>
                                        </form>
                                    </div>
                                    
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

        {{-- =================================================
             SEÇÃO 1: BEST SELLER
             ================================================= --}}
        <section class="book-section">
            <div class="container">
                <h2 class="section-title">Best Seller</h2>

                <div class="book-slider">
                    <button class="arrow-button left-arrow"><i class="fa-solid fa-chevron-left"></i></button>

                    <div class="slider-wrapper">
                        
                        @if($livros->isEmpty())
                            <p style="padding: 20px; color: gray;">Nenhum livro encontrado.</p>
                        @else
                            @foreach($livros as $livro)
                                {{-- CARD ATÔMICO --}}
                                <div class="book-card">
                                    
                                    {{-- Container da Imagem (Corte fixo) --}}
                                    <div class="book-image-container">
                                        <img src="{{ $livro->imagem }}" alt="{{ $livro->titulo }}" class="book-cover">
                                    </div>
                                    
                                    {{-- Informações (Flex Grow) --}}
                                    <div class="book-info">
                                        <h3 class="book-title" title="{{ $livro->titulo }}">
                                            {{ $livro->titulo }}
                                        </h3>
                                        
                                        <p class="book-author">
                                            {{ $livro->author->name }}
                                        </p>
                                        
                                        {{-- Rodapé do Card --}}
                                        <div class="book-footer">
                                            <div class="book-price">
                                                R$ {{ number_format($livro->preco, 2, ',', '.') }}
                                            </div>
                                            
                                            {{-- FORMULÁRIO POST PARA COMPRAR --}}
                                            <form action="{{ route('cart.add', $livro->id) }}" method="POST" style="width: 100%;">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa-solid fa-cart-plus" style="margin-right: 5px;"></i> Comprar
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        @endif

                    </div>

                    <button class="arrow-button right-arrow"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </section>

        {{-- =================================================
             SEÇÃO 2: DESTAQUES DA LOJA
             ================================================= --}}
        <section class="book-section">
            <div class="container">
                <h2 class="section-title">Destaques da Loja</h2>

                <div class="book-slider">
                    <button class="arrow-button left-arrow"><i class="fa-solid fa-chevron-left"></i></button>

                    <div class="slider-wrapper">
                        
                        @if($livros->isEmpty())
                            <p style="padding: 20px; color: gray;">Nenhum livro encontrado.</p>
                        @else
                            @foreach($livros as $livro)
                                {{-- CARD ATÔMICO --}}
                                <div class="book-card">
                                    
                                    {{-- Container da Imagem (Corte fixo) --}}
                                    <div class="book-image-container">
                                        <img src="{{ $livro->imagem }}" alt="{{ $livro->titulo }}" class="book-cover">
                                    </div>
                                    
                                    {{-- Informações (Flex Grow) --}}
                                    <div class="book-info">
                                        <h3 class="book-title" title="{{ $livro->titulo }}">
                                            {{ $livro->titulo }}
                                        </h3>
                                        
                                        <p class="book-author">
                                            {{ $livro->author->name }}
                                        </p>
                                        
                                        {{-- Rodapé do Card --}}
                                        <div class="book-footer">
                                            <div class="book-price">
                                                R$ {{ number_format($livro->preco, 2, ',', '.') }}
                                            </div>
                                            
                                            {{-- FORMULÁRIO POST PARA COMPRAR --}}
                                            <form action="{{ route('cart.add', $livro->id) }}" method="POST" style="width: 100%;">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa-solid fa-cart-plus" style="margin-right: 5px;"></i> Comprar
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        @endif

                    </div>

                    <button class="arrow-button right-arrow"><i class="fa-solid fa-chevron-right"></i></button>
                </div>

                    <button class="arrow-button right-arrow"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </section>

    </main>

    {{-- Script para fazer os carrosséis de livros funcionarem --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sliders = document.querySelectorAll('.book-slider');

        sliders.forEach(slider => {
            const wrapper = slider.querySelector('.slider-wrapper');
            const leftBtn = slider.querySelector('.left-arrow');
            const rightBtn = slider.querySelector('.right-arrow');

            if (leftBtn && wrapper) {
                leftBtn.addEventListener('click', () => {
                    // Rola a largura exata da tela visível (scroll inteligente)
                    const scrollAmount = wrapper.clientWidth; 
                    wrapper.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                });
            }

            if (rightBtn && wrapper) {
                rightBtn.addEventListener('click', () => {
                    const scrollAmount = wrapper.clientWidth;
                    wrapper.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                });
            }
        });
    });
</script>

@endsection