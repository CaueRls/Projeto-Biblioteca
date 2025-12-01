@extends('layouts.admin')

@section('header-title', 'Cadastrar Produto')

@section('content')
<div class="max-w-4xl mx-auto">

    <form action="{{ route('admin.produtos.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Título do Livro --}}
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Título do livro</label>
            <input type="text" name="titulo" required
                class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600"
                placeholder="Ex: Harry Potter e a Pedra Filosofal">
        </div>

        {{-- Sinopse (NOVO CAMPO) --}}
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Sinopse</label>
            <textarea name="sinopse" rows="5" 
                class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600" 
                placeholder="Escreva a descrição do livro aqui..."></textarea>
        </div>

        {{-- Grid de 3 Colunas para os Selects --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            {{-- Autor --}}
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Autor</label>
                <select name="author_id" required
                    class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600 bg-white">
                    <option value="" disabled selected>Selecione um Autor</option>
                    @foreach($autores as $autor)
                    <option value="{{ $autor->id }}">{{ $autor->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Gênero --}}
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Gênero</label>
                <select name="genre_id" required
                    class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600 bg-white">
                    <option value="" disabled selected>Selecione um Gênero</option>
                    @foreach($generos as $genero)
                    <option value="{{ $genero->id }}">{{ $genero->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Editora --}}
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Editora</label>
                <select name="publisher_id" required
                    class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600 bg-white">
                    <option value="" disabled selected>Selecione uma Editora</option>
                    @foreach($editoras as $editora)
                    <option value="{{ $editora->id }}">{{ $editora->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Preço e Imagem lado a lado --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Preço --}}
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Preço (R$)</label>
                <input type="number" step="0.01" name="preco" required
                    class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600"
                    placeholder="0.00">
            </div>

            {{-- Imagem --}}
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Imagem do livro (URL)</label>
                <input type="text" name="imagem" required
                    class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600"
                    placeholder="https://...">
            </div>
        </div>

        {{-- Checkbox Destaque --}}
        <div class="flex items-center gap-2 mt-4 p-4 bg-gray-50 rounded border border-gray-200">
            <input type="checkbox" name="is_featured" value="1" id="is_featured" class="w-5 h-5 text-orange-500 focus:ring-orange-500">
            <label for="is_featured" class="text-gray-700 font-bold cursor-pointer">
                Exibir este livro no Banner Principal (Carrossel)?
            </label>
        </div>

        {{-- Botão Salvar --}}
        <div class="flex justify-end mt-8 pt-4 border-t border-gray-200">
            <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-10 rounded shadow-lg transition duration-200 transform hover:-translate-y-1">
                Cadastrar Produto
            </button>
        </div>

    </form>
</div>
@endsection