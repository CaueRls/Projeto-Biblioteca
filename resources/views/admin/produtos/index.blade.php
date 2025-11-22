@extends('layouts.admin')

@section('header-title', 'Lista de Produtos')

@section('content')
<div class="container mx-auto">

    {{-- Botão de Adicionar Novo (Canto Direito) --}}
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.produtos.create') }}"
            class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Novo Produto
        </a>
    </div>

    {{-- Tabela --}}
    <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
        <table class="min-w-full w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Imagem</th>
                    <th class="py-3 px-6 text-left">Título</th>
                    <th class="py-3 px-6 text-left">Autor</th>
                    <th class="py-3 px-6 text-center">Preço</th>
                    <th class="py-3 px-6 text-center">Ações</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">

                {{-- LOOP DO LARAVEL: Repete essa parte para cada livro --}}
                @foreach($products as $product)
                <tr class="border-b border-gray-200 hover:bg-gray-100">

                    {{-- ID --}}
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <span class="font-medium">{{ $product->id }}</span>
                    </td>

                    {{-- Imagem (Se for URL) --}}
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <img class="w-10 h-10 rounded-full border border-gray-200" src="{{ $product->imagem }}"
                                alt="Capa">
                        </div>
                    </td>

                    {{-- Título e Gênero --}}
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <span class="font-medium">{{ $product->titulo }}</span>
                        </div>
                        <span class="text-xs text-gray-500">{{ $product->genero }}</span>
                    </td>

                    {{-- Autor --}}
                    <td class="py-3 px-6 text-left">
                        <span>{{ $product->autor }}</span>
                    </td>

                    {{-- Preço --}}
                    <td class="py-3 px-6 text-center">
                        <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs">
                            R$ {{ number_format($product->preco, 2, ',', '.') }}
                        </span>
                    </td>

                    {{-- Ações (Editar / Excluir) --}}
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center gap-2">

                            {{-- BOTÃO EDITAR (Link normal) --}}
                            <a href="{{ route('admin.produtos.edit', $product->id) }}"
                                class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110" title="Editar">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            {{-- BOTÃO EXCLUIR (Formulário DELETE) --}}
                            <form action="{{ route('admin.produtos.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 bg-transparent border-none cursor-pointer"
                                    title="Excluir">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach

                {{-- Se não tiver nenhum produto --}}
                @if($products->isEmpty())
                <tr>
                    <td colspan="6" class="py-10 text-center text-gray-500">
                        Nenhum livro cadastrado ainda.
                    </td>
                </tr>
                @endif

            </tbody>
        </table>
    </div>
</div>
@endsection