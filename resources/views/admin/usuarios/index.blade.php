@extends('layouts.admin')

@section('header-title', 'Lista de Usuários')

@section('content')
<div class="container mx-auto">

    {{-- Tabela --}}
    <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
        <table class="min-w-full w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Nome</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-center">Status</th> {{-- NOVA COLUNA --}}
                    <th class="py-3 px-6 text-center">Ações</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                
                @foreach($users as $user)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <span class="font-medium">{{ $user->id }}</span>
                    </td>

                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <div class="mr-2">
                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                            <span class="font-medium">{{ $user->name }}</span>
                        </div>
                    </td>

                    <td class="py-3 px-6 text-left">
                        <span>{{ $user->email }}</span>
                    </td>

                    {{-- COLUNA STATUS (Visual) --}}
                    <td class="py-3 px-6 text-center">
                        @if($user->is_active)
                            <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs font-bold">Ativo</span>
                        @else
                            <span class="bg-red-200 text-red-700 py-1 px-3 rounded-full text-xs font-bold">Inativo</span>
                        @endif
                    </td>

                    {{-- COLUNA AÇÕES (Botão Toggle) --}}
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            
                            {{-- Formulário PATCH para trocar status --}}
                            <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                
                                <button type="submit" class="w-6 transform hover:scale-110 bg-transparent border-none cursor-pointer" 
                                        title="{{ $user->is_active ? 'Desativar Usuário' : 'Ativar Usuário' }}">
                                    
                                    @if($user->is_active)
                                        {{-- Ícone de Desligar (Vermelho se for clicar para desativar) --}}
                                        <i class="fa-solid fa-toggle-on text-green-500 text-xl"></i>
                                    @else
                                        {{-- Ícone de Ligar (Cinza/Verde se for clicar para ativar) --}}
                                        <i class="fa-solid fa-toggle-off text-gray-400 text-xl"></i>
                                    @endif
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection