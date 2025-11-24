@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Meu Carrinho</h1>

    @if(session('cart'))
    <div class="flex flex-col md:flex-row gap-6">
        
        {{-- LISTA DE PRODUTOS --}}
        <div class="w-full md:w-3/4 bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6">Produto</th>
                        <th class="py-3 px-6 text-center">Preço</th>
                        <th class="py-3 px-6 text-center">Qtd</th>
                        <th class="py-3 px-6 text-center">Subtotal</th>
                        <th class="py-3 px-6 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @php $total = 0 @endphp
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-6 flex items-center gap-4">
                                <img src="{{ $details['image'] }}" width="60" height="80" class="rounded border shadow-sm object-cover" style="height: 80px;">
                                <span class="font-medium text-gray-800">{{ $details['name'] }}</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                R$ {{ number_format($details['price'], 2, ',', '.') }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-gray-200 py-1 px-3 rounded text-gray-700 font-bold">
                                    {{ $details['quantity'] }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center font-bold text-blue-600">
                                R$ {{ number_format($details['price'] * $details['quantity'], 2, ',', '.') }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button class="text-red-500 hover:text-red-700 transition transform hover:scale-110">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- RESUMO DO PEDIDO --}}
        <div class="w-full md:w-1/4">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-4 text-gray-800">Resumo</h2>
                <div class="flex justify-between mb-2 text-gray-600">
                    <span>Subtotal</span>
                    <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                </div>
                <div class="flex justify-between mb-4 text-gray-600">
                    <span>Frete</span>
                    <span class="text-green-600">Grátis</span>
                </div>
                <hr class="my-4">
                <div class="flex justify-between mb-6 text-xl font-bold text-gray-900">
                    <span>Total</span>
                    <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                </div>
                <button class="w-full bg-green-600 text-white py-3 rounded-lg font-bold hover:bg-green-700 transition shadow-lg">
                    Finalizar Compra
                </button>
                <a href="{{ route('home') }}" class="block text-center mt-4 text-blue-600 hover:underline">
                    Continuar Comprando
                </a>
            </div>
        </div>

    </div>
    @else
        <div class="text-center py-20">
            <i class="fa-solid fa-cart-shopping text-6xl text-gray-300 mb-4"></i>
            <h2 class="text-2xl font-bold text-gray-600 mb-4">Seu carrinho está vazio</h2>
            <a href="{{ route('home') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-700 transition">
                Começar a Comprar
            </a>
        </div>
    @endif
</div>
@endsection