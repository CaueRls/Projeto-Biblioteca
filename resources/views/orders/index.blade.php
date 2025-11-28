@extends('layouts.app')

@section('content')

{{-- CSS ESPECÍFICO PARA A PÁGINA DE PEDIDOS --}}
<style>
    .orders-page-wrapper {
        background-color: #f3f4f6;
        min-height: 100vh;
        padding: 40px 20px;
    }

    .orders-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .page-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* CARD DO PEDIDO */
    .order-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        border: 1px solid #e5e7eb;
        overflow: hidden;
        margin-bottom: 30px;
    }

    /* CABEÇALHO DO PEDIDO (Cinza) */
    .order-header {
        background-color: #f9fafb;
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }

    .header-info-group {
        display: flex;
        gap: 40px;
    }

    .header-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #6b7280;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .header-value {
        font-size: 0.95rem;
        color: #374151;
        font-weight: 600;
    }

    .order-id {
        font-family: monospace;
        color: #6b7280;
    }

    /* STATUS BADGES */
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 800;
        text-transform: uppercase;
    }
    .status-pago { background-color: #dcfce7; color: #166534; }      /* Verde */
    .status-pendente { background-color: #fef9c3; color: #854d0e; }  /* Amarelo */
    .status-cancelado { background-color: #fee2e2; color: #991b1b; } /* Vermelho */

    /* LISTA DE ITENS */
    .order-items {
        padding: 20px;
    }

    .item-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f3f4f6;
    }
    .item-row:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    /* IMAGEM DO LIVRO (A CORREÇÃO PRINCIPAL) */
    .item-image-container {
        width: 70px;       /* Largura fixa */
        height: 100px;     /* Altura fixa */
        flex-shrink: 0;
        border-radius: 6px;
        overflow: hidden;
        border: 1px solid #eee;
    }

    .item-image {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Garante que a imagem não estoure */
    }

    .item-details {
        flex-grow: 1;
    }

    .item-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #111;
        text-decoration: none;
        margin-bottom: 5px;
        display: block;
    }
    .item-title:hover { color: #2563eb; }

    .item-meta {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 5px;
    }

    /* BOTÃO COMPRAR NOVAMENTE */
    .btn-buy-again {
        padding: 8px 16px;
        border: 1px solid #2563eb;
        color: #2563eb;
        background: white;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.9rem;
    }
    .btn-buy-again:hover {
        background-color: #eff6ff;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
</style>

<div class="orders-page-wrapper">
    <div class="orders-container">
        
        <h1 class="page-title">
            <i class="fa-solid fa-box-open" style="color: #003B71;"></i> Meus Pedidos
        </h1>

        @if($orders->isEmpty())
            <div class="empty-state">
                <i class="fa-solid fa-basket-shopping" style="font-size: 4rem; color: #ddd; margin-bottom: 20px;"></i>
                <h2 style="font-size: 1.5rem; font-weight: bold; color: #333;">Nenhum pedido encontrado</h2>
                <p style="color: #666; margin-bottom: 20px;">Você ainda não comprou nenhum livro conosco.</p>
                <a href="{{ route('home') }}" style="color: #2563eb; font-weight: bold; text-decoration: none;">Ir para a Loja &rarr;</a>
            </div>
        @else
            @foreach($orders as $order)
                <div class="order-card">
                    
                    {{-- CABEÇALHO DO PEDIDO --}}
                    <div class="order-header">
                        <div class="header-info-group">
                            <div>
                                <div class="header-label">Data do Pedido</div>
                                <div class="header-value">{{ $order->created_at->format('d/m/Y') }}</div>
                            </div>
                            <div>
                                <div class="header-label">Total</div>
                                <div class="header-value">R$ {{ number_format($order->total_price, 2, ',', '.') }}</div>
                            </div>
                            <div>
                                <div class="header-label">Enviar Para</div>
                                <div class="header-value">{{ Auth::user()->name }}</div>
                            </div>
                        </div>

                        <div style="text-align: right;">
                            <div class="order-id">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
                            {{-- Lógica de Cor do Status --}}
                            @php
                                $statusColor = 'status-pendente';
                                if($order->status == 'Pago') $statusColor = 'status-pago';
                                if($order->status == 'Cancelado') $statusColor = 'status-cancelado';
                            @endphp
                            <span class="status-badge {{ $statusColor }}" style="display: inline-block; margin-top: 5px;">
                                {{ $order->status }}
                            </span>
                        </div>
                    </div>

                    {{-- LISTA DE ITENS --}}
                    <div class="order-items">
                        @foreach($order->items as $item)
                            <div class="item-row">
                                {{-- 1. Imagem Controlada --}}
                                <div class="item-image-container">
                                    <img src="{{ $item->product->imagem }}" class="item-image" alt="{{ $item->product->titulo }}">
                                </div>

                                {{-- 2. Informações --}}
                                <div class="item-details">
                                    <a href="{{ route('product.show', $item->product_id) }}" class="item-title">
                                        {{ $item->product->titulo }}
                                    </a>
                                    <div class="item-meta">Editora: {{ $item->product->publisher->name }}</div>
                                    <div class="item-meta">
                                        <strong>R$ {{ number_format($item->price, 2, ',', '.') }}</strong> 
                                        <span style="color: #999;">x {{ $item->quantity }} un.</span>
                                    </div>
                                </div>

                                {{-- 3. Botão de Ação --}}
                                <div style="align-self: center;">
                                    <form action="{{ route('cart.add', $item->product_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-buy-again">
                                            <i class="fa-solid fa-rotate-right"></i> Comprar Novamente
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endforeach
        @endif

    </div>
</div>
@endsection