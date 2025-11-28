{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')
<main>

    {{-- =================================================
    HERO CAROUSEL (Apenas se NÃO estiver pesquisando)
    ================================================= --}}
    @if(!request('search'))
    <section class="hero-carousel">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                @if($destaques->isEmpty())
                <div class="swiper-slide">
                    <div class="container">
                        <div class="carousel-slide" style="justify-content: center;">
                            <h2 style="color: white; text-align: center; padding: 50px;">
                                Nenhum destaque cadastrado no momento.
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

                                {{-- Botão do Banner (POST) --}}
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
    @endif

    {{-- =================================================
    SEÇÃO PRINCIPAL (LISTA DE LIVROS)
    ================================================= --}}
    <section class="book-section" style="min-height: 400px;">
        <div class="container">

            {{-- Título Dinâmico: Muda se for pesquisa --}}
            <h2 class="section-title">
                @if(request('search'))
                Resultados para: "{{ request('search') }}"
                @else
                Best Seller
                @endif
            </h2>

            <div class="book-slider">
                <button class="arrow-button left-arrow"><i class="fa-solid fa-chevron-left"></i></button>

                <div class="slider-wrapper">

                    @if($livros->isEmpty())
                    <div style="width: 100%; text-align: center; padding: 40px;">
                        <p style="font-size: 1.2rem; color: gray;">Nenhum livro encontrado.</p>
                        @if(request('search'))
                        <a href="{{ route('home') }}" style="color: blue; text-decoration: underline;">Limpar
                            pesquisa</a>
                        @endif
                    </div>
                    @else
                    @foreach($livros as $livro)
                    {{-- CARD ATÔMICO (Estrutura limpa para o CSS funcionar) --}}
                    <div class="book-card">

                        {{-- 1. Imagem --}}
                        <div class="book-image-container">
                            <img src="{{ $livro->imagem }}" alt="{{ $livro->titulo }}" class="book-cover">
                        </div>

                        {{-- 2. Informações --}}
                        <div class="book-info">
                            <h3 class="book-title" title="{{ $livro->titulo }}">
                                {{ $livro->titulo }}
                            </h3>

                            <p class="book-author">
                                {{ $livro->author->name }}
                            </p>

                            {{-- 3. Rodapé do Card --}}
                            <div class="book-footer">
                                <div class="book-price">
                                    R$ {{ number_format($livro->preco, 2, ',', '.') }}
                                </div>

                                {{-- Botão Comprar (POST) --}}
                                <a href="{{ route('product.show', $livro->id) }}" class="btn-primary"
                                    style="text-decoration: none; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-eye" style="margin-right: 8px;"></i> Ver Detalhes
                                </a>
                            </div>
                        </div>

                    </div>
                    @endforeach
                    @endif

                </div>

                <button class="arrow-button right-arrow"><i class="fa-solid fa-chevron-right"></i></button>
            </div>

            {{-- Paginação (Opcional: Se quiser mostrar botões 1, 2, 3 abaixo do slider) --}}
            {{-- <div class="mt-8">{{ $livros->links() }}</div> --}}
        </div>
    </section>

    {{-- =================================================
    SEÇÃO 2: DESTAQUES DA LOJA (Só aparece se NÃO for pesquisa)
    ================================================= --}}
    @if(!request('search'))
    <section class="book-section">
        <div class="container">
            <h2 class="section-title">Destaques da Loja</h2>

            <div class="book-slider">
                <button class="arrow-button left-arrow"><i class="fa-solid fa-chevron-left"></i></button>

                <div class="slider-wrapper">
                    {{-- Repetindo a lógica para preencher a segunda lista --}}
                    @foreach($livros as $livro)
                    <div class="book-card">
                        <div class="book-image-container">
                            <img src="{{ $livro->imagem }}" alt="{{ $livro->titulo }}" class="book-cover">
                        </div>

                        <div class="book-info">
                            <h3 class="book-title" title="{{ $livro->titulo }}">
                                {{ $livro->titulo }}
                            </h3>
                            <p class="book-author">Editora: {{ $livro->publisher->name }}</p>

                            <div class="book-footer">
                                <div class="book-price">
                                    R$ {{ number_format($livro->preco, 2, ',', '.') }}
                                </div>
                                <a href="{{ route('product.show', $livro->id) }}" class="btn-primary"
                                    style="text-decoration: none; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-eye" style="margin-right: 8px;"></i> Ver Detalhes
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button class="arrow-button right-arrow"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </section>
    @endif

</main>

{{-- SCRIPT DE ROLAGEM DOS LIVROS --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sliders = document.querySelectorAll('.book-slider');

        sliders.forEach(slider => {
            const wrapper = slider.querySelector('.slider-wrapper');
            const leftBtn = slider.querySelector('.left-arrow');
            const rightBtn = slider.querySelector('.right-arrow');

            if (leftBtn && wrapper) {
                leftBtn.addEventListener('click', () => {
                    // Rola a largura exata visível (3 livros no desktop)
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