@extends('layouts.admin')

@section('header-title', 'Resultados da Busca')

@section('content')
<div class="container mx-auto">

    <div class="mb-8">
        <h2 class="text-xl text-gray-600">
            Resultados para: <span class="font-bold text-gray-900 text-2xl">"{{ $query }}"</span>
        </h2>
    </div>

    {{-- 1. RESULTADOS DE PRODUTOS --}}
    <div class="mb-12">
        <div class="flex items-center gap-2 mb-4 border-b border-gray-200 pb-2">
            <i class="fa-solid fa-book text-blue-600"></i>
            <h3 class="text-lg font-bold text-gray-800">Produtos Encontrados ({{ $products->count() }})</h3>
        </div>

        @if($products->isEmpty())
            <p class="text-gray-500 italic bg-gray-50 p-4 rounded-lg">Nenhum livro encontrado com esse termo.</p>
        @else
            <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                            <th class="px-5 py-3">Capa</th>
                            <th class="px-5 py-3">Título</th>
                            <th class="px-5 py-3">Autor</th>
                            <th class="px-5 py-3 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($products as $product)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-5 py-3">
                                    <img src="{{ $product->imagem }}" class="w-10 h-14 object-cover rounded shadow-sm border border-gray-200">
                                </td>
                                <td class="px-5 py-3">
                                    <span class="text-gray-900 font-bold block">{{ $product->titulo }}</span>
                                    <span class="text-xs text-gray-500">{{ $product->genre->name }}</span>
                                </td>
                                <td class="px-5 py-3 text-sm text-gray-700">
                                    {{ $product->author->name }}
                                </td>
                                <td class="px-5 py-3 text-center">
                                    <a href="{{ route('admin.produtos.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900 font-bold text-sm">
                                        <i class="fa-solid fa-pen-to-square mr-1"></i> Editar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- 2. RESULTADOS DE USUÁRIOS --}}
    <div>
        <div class="flex items-center gap-2 mb-4 border-b border-gray-200 pb-2">
            <i class="fa-solid fa-users text-blue-600"></i>
            <h3 class="text-lg font-bold text-gray-800">Usuários Encontrados ({{ $users->count() }})</h3>
        </div>

        @if($users->isEmpty())
            <p class="text-gray-500 italic bg-gray-50 p-4 rounded-lg">Nenhum usuário encontrado com esse termo.</p>
        @else
            <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                            <th class="px-5 py-3">Nome</th>
                            <th class="px-5 py-3">Email</th>
                            <th class="px-5 py-3 text-center">Status</th>
                            <th class="px-5 py-3 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-5 py-3">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3 font-bold text-xs">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                        <span class="text-gray-900 font-bold">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-3 text-sm text-gray-600">
                                    {{ $user->email }}
                                </td>
                                <td class="px-5 py-3 text-center">
                                    @if($user->is_active)
                                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full text-xs">Ativo</span>
                                    @else
                                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full text-xs">Inativo</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3 text-center">
                                    <span class="text-gray-400 text-xs">-</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>
@endsection