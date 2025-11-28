@extends('layouts.app')

@section('content')

<style>
    .checkout-page {
        background-color: #f3f4f6; /* Fundo cinza claro da página */
        min-height: 100vh;
        padding: 40px 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .checkout-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1.8fr 1fr; /* Esquerda maior, Direita menor */
        gap: 30px;
    }

    @media (max-width: 900px) {
        .checkout-grid { grid-template-columns: 1fr; }
        .summary-column { order: -1; margin-bottom: 20px; }
    }

    /* --- ESTILO DOS BLOCOS (Igual à imagem) --- */
    .checkout-block {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        overflow: hidden; /* Para o header não sair pra fora */
        margin-bottom: 25px;
        border: 1px solid #e5e7eb;
    }

    .block-header {
        background-color: #F29900; /* Laranja do Senac/Imagem */
        color: white;
        padding: 15px 20px;
        font-size: 1.1rem;
        font-weight: 800;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .block-body {
        padding: 25px;
    }

    /* --- FORMULÁRIO --- */
    .form-group { margin-bottom: 20px; }
    
    .form-label {
        display: block;
        font-weight: 700;
        color: #4b5563;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .form-input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        outline: none;
        font-size: 1rem;
        color: #333;
        transition: border-color 0.2s;
    }
    .form-input:focus { border-color: #F29900; box-shadow: 0 0 0 3px rgba(242, 153, 0, 0.1); }

    .form-row { 
        display: flex; 
        gap: 20px; 
    }
    
    .form-col { flex: 1; }
    .form-col-small { width: 150px; flex: none; }

    @media (max-width: 600px) {
        .form-row { flex-direction: column; gap: 15px; }
        .form-col-small { width: 100%; }
    }

    /* --- RESUMO DO PEDIDO --- */
    .product-row {
        display: flex;
        gap: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f3f4f6;
        margin-bottom: 15px;
    }
    .product-img {
        width: 60px;
        height: 85px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #eee;
    }
    .product-info h4 {
        font-size: 0.95rem;
        font-weight: 700;
        color: #333;
        margin: 0 0 5px 0;
        line-height: 1.2;
    }
    .product-info p {
        font-size: 0.85rem;
        color: #666;
        margin: 0;
    }
    .product-price {
        margin-left: auto;
        font-weight: 700;
        color: #003B71;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        color: #555;
        font-size: 0.95rem;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #eee;
        font-size: 1.6rem;
        font-weight: 800;
        color: #1f2937;
        align-items: center;
    }

    /* --- PAGAMENTO --- */
    .payment-option {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        padding: 10px 0;
    }
    .payment-option input {
        width: 18px;
        height: 18px;
        accent-color: #F29900;
    }
    .payment-label {
        font-weight: 600;
        color: #333;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* BOTÃO FINALIZAR */
    .btn-confirm {
        width: 100%;
        background-color: #22c55e; /* Verde igual da imagem */
        color: white;
        font-size: 1.2rem;
        font-weight: 700;
        padding: 15px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin-top: 25px;
        transition: background 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .btn-confirm:hover { background-color: #16a34a; }

    .secure-badge {
        text-align: center;
        margin-top: 15px;
        font-size: 0.9rem;
        color: #666;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

</style>

<div class="checkout-page">
    <div class="checkout-container">
        
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            
            <div class="checkout-grid">
                
                {{-- COLUNA ESQUERDA (FORMULÁRIOS) --}}
                <div class="forms-column">
                    
                    {{-- 1. DADOS PESSOAIS --}}
                    <div class="checkout-block">
                        <div class="block-header">
                            <i class="fa-solid fa-user"></i> Dados Pessoais
                        </div>
                        <div class="block-body">
                            <div class="form-group">
                                <label class="form-label">Nome Completo</label>
                                <input type="text" class="form-input" name="name" value="{{ Auth::user()->name ?? '' }}" required>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-col">
                                    <label class="form-label">E-mail</label>
                                    <input type="email" class="form-input" name="email" value="{{ Auth::user()->email ?? '' }}" required>
                                </div>
                                <div class="form-col">
                                    <label class="form-label">CPF</label>
                                    <input type="text" class="form-input" name="cpf" placeholder="000.000.000-00" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2. ENDEREÇO --}}
                    <div class="checkout-block">
                        <div class="block-header">
                            <i class="fa-solid fa-map-location-dot"></i> Endereço de Entrega
                        </div>
                        <div class="block-body">
                            <div class="form-row">
                                <div class="form-col-small">
                                    <label class="form-label">CEP</label>
                                    <input type="text" class="form-input" name="cep" placeholder="00000-000">
                                </div>
                                <div class="form-col">
                                    <label class="form-label">Rua / Avenida</label>
                                    <input type="text" class="form-input" name="address" required>
                                </div>
                            </div>

                            <div class="form-row" style="margin-top: 20px;">
                                <div class="form-col-small">
                                    <label class="form-label">Número</label>
                                    <input type="text" class="form-input" name="number" required>
                                </div>
                                <div class="form-col">
                                    <label class="form-label">Bairro</label>
                                    <input type="text" class="form-input" name="neighborhood" required>
                                </div>
                                <div class="form-col">
                                    <label class="form-label">Cidade</label>
                                    <input type="text" class="form-input" name="city" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 3. PAGAMENTO --}}
                    <div class="checkout-block">
                        <div class="block-header">
                            <i class="fa-regular fa-credit-card"></i> Pagamento
                        </div>
                        <div class="block-body">
                            <label class="payment-option">
                                <input type="radio" name="payment" value="credit_card" checked>
                                <span class="payment-label">
                                    <i class="fa-brands fa-cc-visa text-xl"></i> Cartão de Crédito
                                </span>
                            </label>
                            
                            <label class="payment-option">
                                <input type="radio" name="payment" value="pix">
                                <span class="payment-label">
                                    <i class="fa-brands fa-pix text-xl text-green-600"></i> PIX
                                </span>
                            </label>
                        </div>
                    </div>

                </div>

                {{-- COLUNA DIREITA (RESUMO) --}}
                <div class="summary-column">
                    <div class="checkout-block" style="position: sticky; top: 20px;">
                        <div class="block-header">
                            Resumo do Pedido
                        </div>
                        <div class="block-body">
                            
                            {{-- Lista de Itens --}}
                            @php $total = 0 @endphp
                            @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                    <div class="product-row">
                                        <img src="{{ $details['image'] }}" class="product-img">
                                        <div class="product-info">
                                            <h4>{{ $details['name'] }}</h4>
                                            <p>Qtd: {{ $details['quantity'] }}</p>
                                        </div>
                                        <div class="product-price">
                                            R$ {{ number_format($details['price'] * $details['quantity'], 2, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            {{-- Totais --}}
                            <div class="summary-row" style="margin-top: 20px;">
                                <span>Subtotal</span>
                                <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                            </div>
                            <div class="summary-row">
                                <span>Frete</span>
                                <span style="color: #22c55e; font-weight: bold;">Grátis</span>
                            </div>

                            <div class="total-row">
                                <span>Total</span>
                                <span style="color: #1f2937;">R$ {{ number_format($total, 2, ',', '.') }}</span>
                            </div>

                            {{-- Botão de Confirmação --}}
                            <button type="submit" class="btn-confirm">
                                <i class="fa-solid fa-check-circle"></i> Confirmar Pedido
                            </button>

                            <div class="secure-badge">
                                <i class="fa-solid fa-lock"></i> Ambiente Seguro
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection