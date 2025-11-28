@extends('layouts.app')

@section('content')

{{-- CSS BLINDADO PARA A PÁGINA DE PRODUTO --}}
<style>
    .product-page-wrapper {
        background-color: #f3f4f6;
        min-height: 100vh;
        padding: 40px 20px;
    }

    .product-card-container {
        max-width: 1100px;
        margin: 0 auto;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }

    /* GRID DE DUAS COLUNAS */
    .product-grid {
        display: grid;
        grid-template-columns: 1fr 1fr; /* 50% para cada lado */
        gap: 0;
    }

    /* Responsivo para celular */
    @media (max-width: 900px) {
        .product-grid { grid-template-columns: 1fr; }
    }

    /* --- COLUNA DA ESQUERDA (IMAGENS) --- */
    .product-gallery {
        padding: 40px;
        background-color: #fff;
        border-right: 1px solid #eee;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .main-image-box {
        width: 100%;
        max-width: 380px; /* Tamanho máximo da capa */
        height: 550px;    /* Altura fixa para não quebrar */
        background-color: #f9fafb;
        border-radius: 10px;
        border: 2px solid #003B71; /* Borda azul igual ao seu desenho */
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        position: relative; /* Importante para o botão flutuante */
    }

    .main-image {
        width: 100%;
        height: 100%;
        object-fit: contain; /* Mostra a capa inteira sem cortar */
        border-radius: 5px;
    }

    /* Botão Favorito Flutuante (Grande) */
    .btn-fav-large {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: white;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #ccc;
        cursor: pointer;
        transition: all 0.2s;
        z-index: 10;
    }
    .btn-fav-large:hover {
        transform: scale(1.1);
        color: #ef4444;
        box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }
    .btn-fav-active {
        color: #ef4444;
        border-color: #fee2e2;
        background-color: #fff1f2;
    }

    /* Miniaturas */
    .thumbnails-row {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .thumb-box {
        width: 70px;
        height: 70px;
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .thumb-box:hover { border-color: #003B71; }
    .thumb-box img { width: 100%; height: 100%; object-fit: contain; }

    /* --- COLUNA DA DIREITA (INFO) --- */
    .product-info {
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: #FAF9F6; /* Cor begezinha do seu desenho */
    }

    .product-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1f2937;
        line-height: 1.1;
        margin-bottom: 10px;
        font-family: serif; /* Fonte serifada estilosa */
    }

    .product-meta {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 30px;
    }
    .product-meta strong { color: #333; }

    .product-synopsis-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
        border-bottom: 2px solid #ddd;
        display: inline-block;
        padding-bottom: 5px;
    }

    .product-synopsis {
        font-size: 1rem;
        color: #555;
        line-height: 1.6;
        margin-bottom: 30px;
        text-align: justify;
    }

    .product-price-tag {
        background-color: #ea580c; /* Laranja */
        color: white;
        font-size: 1.8rem;
        font-weight: bold;
        padding: 10px 25px;
        border-radius: 8px;
        display: inline-block;
        box-shadow: 0 4px 10px rgba(234, 88, 12, 0.3);
        margin-bottom: 30px;
    }

    /* FORMULÁRIO E BOTÕES */
    .action-area {
        display: flex;
        gap: 15px;
        align-items: stretch;
        border-top: 1px solid #ddd;
        padding-top: 30px;
    }

    .qty-wrapper {
        display: flex;
        align-items: center;
        border: 2px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        background: white;
    }

    .qty-btn {
        background: #f3f4f6;
        border: none;
        width: 40px;
        height: 100%;
        font-size: 1.2rem;
        cursor: pointer;
        color: #555;
    }
    .qty-btn:hover { background: #e5e7eb; }

    .qty-input {
        width: 50px;
        text-align: center;
        border: none;
        font-weight: bold;
        font-size: 1.1rem;
        outline: none;
        -moz-appearance: textfield;
    }

    .btn-add-cart {
        flex-grow: 1;
        background-color: #003B71;
        color: white;
        font-size: 1.1rem;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        padding: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: background 0.2s;
        box-shadow: 0 4px 15px rgba(0, 59, 113, 0.2);
    }
    .btn-add-cart:hover { background-color: #002a52; }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #666;
        text-decoration: none;
        font-weight: 600;
    }
    .back-link:hover { color: #003B71; }

</style>

<div class="product-page-wrapper">
    
    {{-- CARTÃO PRINCIPAL --}}
    <div class="product-card-container">
        <div class="product-grid">
            
            {{-- LADO ESQUERDO: FOTO --}}
            <div class="product-gallery">
                {{-- Imagem Grande com Borda --}}
                <div class="main-image-box">
                    
                    {{-- BOTÃO FAVORITAR (NOVO!) --}}
                    @auth
                        @php
                            // Lógica rápida para checar se é favorito direto na View
                            $isFavorite = \App\Models\Favorite::where('user_id', Auth::id())
                                ->where('product_id', $product->id)
                                ->exists();
                        @endphp
                        <form action="{{ route('favorites.toggle', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-fav-large {{ $isFavorite ? 'btn-fav-active' : '' }}" title="{{ $isFavorite ? 'Remover dos Favoritos' : 'Adicionar aos Favoritos' }}">
                                <i class="{{ $isFavorite ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                            </button>
                        </form>
                    @endauth

                    <img src="{{ $product->imagem }}" alt="{{ $product->titulo }}" class="main-image">
                </div>

                {{-- Galeria Simulada --}}
                <div class="thumbnails-row">
                    <button class="text-2xl text-gray-400"><i class="fa-solid fa-chevron-left"></i></button>
                    
                    <div class="thumb-box">
                        <img src="{{ $product->imagem }}">
                    </div>
                    <div class="thumb-box" style="opacity: 0.5;">
                        <img src="{{ $product->imagem }}" style="filter: grayscale(100%);">
                    </div>
                    <div class="thumb-box" style="opacity: 0.5;">
                        <img src="{{ $product->imagem }}" style="filter: grayscale(100%);">
                    </div>

                    <button class="text-2xl text-gray-400"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>

            {{-- LADO DIREITO: INFORMAÇÕES (Fundo Bege) --}}
            <div class="product-info">
                
                <h1 class="product-title">{{ $product->titulo }}</h1>
                
                <div class="product-meta">
                    <p>Autor: <strong>{{ $product->author->name }}</strong></p>
                    <p>Editora: <strong>{{ $product->publisher->name }}</strong></p>
                    <p>Gênero: <strong>{{ $product->genre->name }}</strong></p>
                </div>

                <div>
                    <h3 class="product-synopsis-title">Sinopse</h3>
                    <p class="product-synopsis">
                        {{-- Se tiver sinopse, mostra. Se não, mostra aviso. --}}
                        {{ $product->sinopse ?? 'Sinopse não disponível para este livro.' }}
                    </p>
                </div>

                <div>
                    <span class="product-price-tag">
                        R$ {{ number_format($product->preco, 2, ',', '.') }}
                    </span>
                </div>

                {{-- Formulário de Compra --}}
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="action-area">
                    @csrf
                    
                    {{-- Seletor de Quantidade Customizado --}}
                    <div class="qty-wrapper">
                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="qty-btn">-</button>
                        <input type="number" name="quantity" value="1" min="1" max="10" class="qty-input">
                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="qty-btn">+</button>
                    </div>

                    <button type="submit" class="btn-add-cart">
                        <i class="fa-solid fa-cart-plus"></i> Adicionar ao Carrinho
                    </button>
                </form>

            </div>

        </div>
    </div>

    {{-- Botão Voltar --}}
    <a href="{{ route('home') }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i> Voltar para a Loja
    </a>

</div>
@endsection