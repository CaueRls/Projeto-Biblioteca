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

        {{-- Autor --}}
        <div>
            <select name="author_id" class="...">
                @foreach($autores as $autor)
                <option value="{{ $autor->id }}">{{ $autor->name }}</option>
            @endforeach
            </select>
        </div>

        {{-- Gênero --}}
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Gênero</label>
            <input type="text" name="genero" value="{{ $product->genero }}" class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600">
        </div>

        {{-- Imagem --}}
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Imagem (URL)</label>
            <input type="text" name="imagem" value="{{ $product->imagem }}" class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600">
        </div>

        {{-- Preço --}}
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Preço</label>
            <input type="text" name="preco" value="{{ $product->preco }}" class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600">
        </div>

        {{-- Editora --}}
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Editora</label>
            <input type="text" name="editora" value="{{ $product->editora }}" class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600">
        </div>

        {{-- Botões --}}
        <div class="flex justify-end gap-4 mt-8">
            <a href="{{ route('admin.produtos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded shadow">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded shadow transition duration-200">
                Salvar Alterações
            </button>
        </div>

    </form>
</div>
@endsection