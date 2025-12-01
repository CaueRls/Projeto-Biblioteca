@extends('layouts.admin')

@section('header-title', 'Editar Produto')

@section('content')
<div class="max-w-4xl mx-auto">
    
    {{-- A rota aponta para o UPDATE passando o ID do produto --}}
    <form action="{{ route('admin.produtos.update', $product->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT') {{-- O HTML não aceita PUT nativo, o Laravel simula isso --}}

        {{-- Título --}}
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Título do livro</label>
            <input type="text" name="titulo" value="{{ $product->titulo }}" class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600">
        </div>

        {{-- SINOPSE (Mantendo o valor antigo) --}}
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Sinopse</label>
            <textarea name="sinopse" rows="5" class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600" placeholder="Escreva a descrição do livro aqui...">{{ $product->sinopse }}</textarea>
        </div>

        {{-- GRID DE 3 COLUNAS PARA OS SELECTS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            {{-- Autor (Corrigido para SELECT com SELECTED) --}}
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Autor</label>
                <select name="author_id" class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600 bg-white">
                    @foreach($autores as $autor)
                        <option value="{{ $autor->id }}" {{ $product->author_id == $autor->id ? 'selected' : '' }}>
                            {{ $autor->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Gênero (Corrigido para SELECT com SELECTED) --}}
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Gênero</label>
                <select name="genre_id" class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600 bg-white">
                    @foreach($generos as $genero)
                        <option value="{{ $genero->id }}" {{ $product->genre_id == $genero->id ? 'selected' : '' }}>
                            {{ $genero->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Editora (Corrigido para SELECT com SELECTED) --}}
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Editora</label>
                <select name="publisher_id" class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600 bg-white">
                    @foreach($editoras as $editora)
                        <option value="{{ $editora->id }}" {{ $product->publisher_id == $editora->id ? 'selected' : '' }}>
                            {{ $editora->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Grid Preço e Imagem --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Imagem --}}
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Imagem (URL)</label>
                <input type="text" name="imagem" value="{{ $product->imagem }}" class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600">
            </div>

            {{-- Preço --}}
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Preço</label>
                <input type="number" step="0.01" name="preco" value="{{ $product->preco }}" class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600">
            </div>
        </div>

        {{-- Checkbox Destaque --}}
        <div class="flex items-center gap-2 mt-4 p-4 bg-gray-50 rounded border border-gray-200">
            <input type="checkbox" name="is_featured" value="1" id="is_featured" class="w-5 h-5 text-orange-500 focus:ring-orange-500"
                {{ $product->is_featured ? 'checked' : '' }}>
            
            <label for="is_featured" class="text-gray-700 font-bold cursor-pointer">
                Exibir este livro no Banner Principal (Carrossel)?
            </label>
        </div>

        {{-- Botões --}}
        <div class="flex justify-end gap-4 mt-8 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.produtos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded shadow transition">
                Cancelar
            </a>
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-10 rounded shadow-lg transition duration-200 transform hover:-translate-y-1">
                Salvar Alterações
            </button>
        </div>

    </form>
</div>
@endsection