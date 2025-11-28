@extends('layouts.app')

@section('content')

<style>
    .favorites-page {
        background-color: #f3f4f6;
        min-height: 100vh;
        padding: 60px 20px;
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    .container-fav {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Header com animação */
    .page-header {
        margin-bottom: 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        animation: fadeInDown 0.6s ease;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .title-icon {
        font-size: 2.2rem;
        color: #ef4444;
        animation: heartbeat 1.5s infinite;
    }

    @keyframes heartbeat {
        0%, 100% { transform: scale(1); }
        10%, 30% { transform: scale(1.1); }
        20%, 40% { transform: scale(1); }
    }

    .items-badge {
        background: white;
        color: #6b7280;
        font-weight: 600;
        padding: 8px 20px;
        border-radius: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        font-size: 0.95rem;
    }

    /* Grid responsivo melhorado */
    .favorites-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 30px;
        animation: fadeIn 0.8s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Card com efeitos premium */
    .fav-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        flex-direction: column;
        position: relative;
        border: 1px solid rgba(255, 255, 255, 0.8);
    }

    .fav-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: #2563eb;
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .fav-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .fav-card:hover::before {
        transform: scaleX(1);
    }

    /* Botão remover estilizado */
    .btn-remove-fav {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 2px solid #fee2e2;
        color: #ef4444;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        font-size: 1.1rem;
    }

    .btn-remove-fav:hover {
        background: #ef4444;
        color: white;
        transform: scale(1.15) rotate(90deg);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
    }

    /* Container da imagem - ALINHAMENTO MELHORADO */
    .fav-img-container {
        width: 100%;
        height: 360px;
        background-color: #f9fafb;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px;
        overflow: hidden;
        position: relative;
    }

    .fav-img-container::after {
        display: none;
    }

    .fav-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        border-radius: 4px;
        transition: all 0.4s ease;
        position: relative;
        z-index: 1;
    }

    .fav-card:hover .fav-img {
        transform: scale(1.08) translateY(-5px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.25);
    }

    /* Informações do produto */
    .fav-info {
        padding: 24px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .fav-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
        line-height: 1.4;
        text-decoration: none;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 3em;
        transition: color 0.3s ease;
    }

    .fav-title:hover {
        color: #3b82f6;
    }

    .fav-author {
        font-size: 0.9rem;
        color: #6b7280;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 12px;
    }

    .fav-author i {
        color: #9ca3af;
        font-size: 0.85rem;
    }

    /* Preço destacado - COR ORIGINAL */
    .fav-price {
        font-size: 1.75rem;
        font-weight: 900;
        color: #003B71;
        margin-top: auto;
        margin-bottom: 16px;
        letter-spacing: -0.5px;
    }

    /* Botão de compra melhorado - COR ORIGINAL */
    .btn-move-cart {
        width: 100%;
        background-color: #2563eb;
        color: white;
        font-weight: 700;
        padding: 14px;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 1rem;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-move-cart::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-move-cart:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-move-cart:hover {
        background-color: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.5);
    }

    .btn-move-cart i {
        font-size: 1.1rem;
        position: relative;
        z-index: 1;
    }

    /* Estado vazio melhorado */
    .empty-fav {
        text-align: center;
        padding: 100px 40px;
        background: white;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        max-width: 650px;
        margin: 60px auto;
        border: 2px solid #f3f4f6;
        animation: fadeInScale 0.6s ease;
    }

    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .empty-icon {
        font-size: 5rem;
        color: #e5e7eb;
        margin-bottom: 24px;
        animation: floatIcon 3s ease-in-out infinite;
    }

    @keyframes floatIcon {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }

    .empty-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 12px;
    }

    .empty-text {
        color: #6b7280;
        line-height: 1.8;
        font-size: 1.05rem;
        margin-bottom: 30px;
    }

    .btn-explore {
        background-color: #004B8D;
        color: white;
        padding: 16px 48px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(0, 75, 141, 0.3);
        font-size: 1.05rem;
        letter-spacing: 0.5px;
    }

    .btn-explore:hover {
        background-color: #002a52;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0, 75, 141, 0.4);
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem;
        }

        .favorites-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .fav-img-container {
            height: 280px;
        }

        .empty-fav {
            padding: 60px 30px;
        }
    }
</style>

<div class="favorites-page">
    <div class="container-fav">
        
        <div class="page-header">
            <h1 class="page-title">
                <i class="fa-solid fa-heart title-icon"></i>
                Meus Favoritos
            </h1>
            <span class="items-badge">
                <i class="fa-solid fa-bookmark"></i> {{ count($favorites) }} {{ count($favorites) === 1 ? 'item salvo' : 'itens salvos' }}
            </span>
        </div>

        @if($favorites->isEmpty())
            <div class="empty-fav">
                <div class="empty-icon">
                    <i class="fa-regular fa-heart"></i>
                </div>
                <h2 class="empty-title">
                    Sua lista de desejos está vazia
                </h2>
                <p class="empty-text">
                    Explore nossa coleção e salve os livros que chamarem sua atenção! <br>
                    Todos os seus favoritos ficarão guardados aqui para quando você decidir comprar.
                </p>
                <a href="{{ route('home') }}" class="btn-explore">
                    <i class="fa-solid fa-compass"></i> Explorar Catálogo
                </a>
            </div>
        @else
            <div class="favorites-grid">
                @foreach($favorites as $fav)
                    @php $livro = $fav->product; @endphp
                    
                    <div class="fav-card">
                        
                        <form action="{{ route('favorites.toggle', $livro->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-remove-fav" title="Remover dos favoritos">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </form>

                        <div class="fav-img-container">
                            <a href="{{ route('product.show', $livro->id) }}">
                                <img src="{{ $livro->imagem }}" alt="{{ $livro->titulo }}" class="fav-img">
                            </a>
                        </div>

                        <div class="fav-info">
                            <a href="{{ route('product.show', $livro->id) }}" class="fav-title" title="{{ $livro->titulo }}">
                                {{ $livro->titulo }}
                            </a>
                            
                            <p class="fav-author">
                                <i class="fa-solid fa-user-pen"></i>
                                {{ $livro->author->name }}
                            </p>
                            
                            <div class="fav-price">
                                R$ {{ number_format($livro->preco, 2, ',', '.') }}
                            </div>

                            <form action="{{ route('cart.add', $livro->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-move-cart">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <span>Adicionar ao Carrinho</span>
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>

@endsection