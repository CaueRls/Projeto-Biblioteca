@extends('layouts.app')

@section('content')

{{-- CSS ESPECÍFICO PARA O CARRINHO (PARA FORÇAR O DESIGN CORRETO) --}}
<style>
    .cart-page-wrapper {
        background-color: #f3f4f6; /* Fundo cinza claro */
        min-height: 100vh;
        padding: 40px 0;
    }
    
    .cart-grid {
        display: grid;
        grid-template-columns: 1fr 350px; /* Coluna produtos larga, Resumo fixo */
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Responsivo para celular */
    @media (max-width: 900px) {
        .cart-grid { grid-template-columns: 1fr; }
    }

    /* --- CARD DE PRODUTO --- */
    .cart-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #eee;
    }

    .cart-item:last-child { border-bottom: none; }

    /* AQUI ESTÁ A CORREÇÃO DA IMAGEM GIGANTE */
    .cart-item-img-container {
        width: 80px;        /* Largura fixa */
        height: 120px;      /* Altura fixa */
        flex-shrink: 0;     /* Não deixa esmagar */
        margin-right: 20px;
        border-radius: 6px;
        overflow: hidden;
        border: 1px solid #eee;
    }

    .cart-item-img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Garante que a imagem caiba sem distorcer */
    }

    .cart-item-info { flex-grow: 1; }

    .cart-item-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 5px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .cart-item-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
    }

    /* --- CARD DE RESUMO --- */
    .summary-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        height: fit-content;
        position: sticky;
        top: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        color: #666;
        font-size: 0.95rem;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #eee;
        font-size: 1.4rem;
        font-weight: 800;
        color: #333;
    }

    /* BOTÕES */
    .btn-remove {
        background: none;
        border: none;
        color: #ef4444;
        cursor: pointer;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: color 0.2s;
    }
    .btn-remove:hover { color: #b91c1c; text-decoration: underline; }

    .btn-checkout {
        width: 100%;
        background-color: #22c55e; /* Verde */
        color: white;
        padding: 15px;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: bold;
        border: none;
        cursor: pointer;
        margin-top: 20px;
        transition: background 0.2s;
        text-align: center;
        display: block;
    }
    .btn-checkout:hover { background-color: #16a34a; }

    .btn-continue {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: #3b82f6;
        text-decoration: none;
        font-weight: 600;
    }
    .btn-continue:hover { text-decoration: underline; }
</style>

<div class="cart-page-wrapper">
    
    {{-- Título da Página --}}
    <div class="container mx-auto px-4 mb-6">
        <h1 style="font-size: 2rem; font-weight: bold; color: #1f2937;">
            <i class="fa-solid fa-bag-shopping" style="color: #003B71;"></i> Seu Carrinho
        </h1>
    </div>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="cart-grid">
            
            {{-- COLUNA ESQUERDA: Lista de Produtos --}}
            <div class="cart-items-column">
                <div class="cart-card">
                    @php $total = 0 @endphp
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        
                        <div class="cart-item">
                            {{-- 1. Imagem Controlada --}}
                            <div class="cart-item-img-container">
                                <img src="{{ $details['image'] }}" class="cart-item-img" alt="{{ $details['name'] }}">
                            </div>

                            {{-- 2. Detalhes --}}
                            <div class="cart-item-info">
                                <h3 class="cart-item-title">{{ $details['name'] }}</h3>
                                <p style="color: #666; font-size: 0.9rem;">Quantidade: {{ $details['quantity'] }}</p>
                                
                                <div class="cart-item-actions">
                                    <span style="font-weight: bold; font-size: 1.2rem; color: #003B71;">
                                        R$ {{ number_format($details['price'], 2, ',', '.') }}
                                    </span>

                                    {{-- Botão Remover --}}
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button type="submit" class="btn-remove">
                                            <i class="fa-solid fa-trash"></i> Remover
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- COLUNA DIREITA: Resumo do Pedido --}}
            <div class="summary-column">
                <div class="summary-card">
                    <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 20px; color: #333;">Resumo</h2>
                    
                    <div class="summary-row">
                        <span>Produtos ({{ count(session('cart')) }})</span>
                        <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Frete</span>
                        <span style="color: #16a34a; font-weight: bold;">Grátis</span>
                    </div>

                    <div class="summary-total">
                        <span>Total</span>
                        <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                    </div>

                    <button class="btn-checkout">
                        Finalizar Compra
                    </button>

                    <a href="{{ route('home') }}" class="btn-continue">
                        Escolher mais livros
                    </a>
                </div>
            </div>

        </div>
    @else
        {{-- CARRINHO VAZIO --}}
        <div style="text-align: center; padding: 100px 20px;">
            <i class="fa-solid fa-cart-plus" style="font-size: 5rem; color: #ddd; margin-bottom: 20px;"></i>
            <h2 style="font-size: 1.8rem; font-weight: bold; color: #666;">Seu carrinho está vazio</h2>
            <p style="color: #999; margin-bottom: 30px;">Que tal adicionar alguns clássicos?</p>
            <a href="{{ route('home') }}" class="btn-checkout" style="max-width: 300px; margin: 0 auto;">
                Ir para a Loja
            </a>
        </div>
    @endif

</div>
@endsection