@extends('layouts.admin')

@section('header-title', 'Cadastrar Produto')

@section('content')
<div class="max-w-4xl mx-auto">

    <form action="{{ route('admin.produtos.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Título do Livro --}}
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Título do livro</label>
            <input type="text" name="titulo"
                class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600">
        </div>

        {{-- Autor --}}
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Autor</label>
            <select name="author_id"
                class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600 bg-white">>
                <option value="" disabled selected>Selecione um Gênero</option>
                @foreach($autores as $autor)
                <option value="{{ $autor->id }}">{{ $autor->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Gênero --}}
        {{-- GÊNERO --}}
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Gênero</label>
            {{-- Atenção ao name="genre_id" --}}
            <select name="genre_id"
                class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600 bg-white">
                <option value="" disabled selected>Selecione um Gênero</option>
                @foreach($generos as $genero)
                {{-- Enviamos o ID, mas mostramos o Nome --}}
                <option value="{{ $genero->id }}">{{ $genero->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Imagem --}}
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Imagem do livro (URL)</label>
            <input type="text" name="imagem"
                class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600">
        </div>

        {{-- Preço --}}
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Preço</label>
            <input type="text" name="preco"
                class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600">
        </div>

        {{-- Editora --}}
        {{-- EDITORA --}}
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Editora</label>
            {{-- Atenção ao name="publisher_id" --}}
            <select name="publisher_id"
                class="w-full border border-gray-400 rounded p-2 focus:outline-none focus:border-blue-600 bg-white">
                <option value="" disabled selected>Selecione uma Editora</option>
                @foreach($editoras as $editora)
                <option value="{{ $editora->id }}">{{ $editora->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Botão --}}
        <div class="flex justify-end mt-8">
            <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-8 rounded shadow-lg transition duration-200">
                Cadastrar
            </button>
        </div>

    </form>
</div>
@endsection