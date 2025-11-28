<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class AdminSearchController extends Controller
{
    public function search(Request $request)
    {
        // 1. Pega o termo digitado (se estiver vazio, redireciona de volta)
        $query = $request->input('admin_search');

        if (!$query) {
            return redirect()->back();
        }

        // 2. Busca em PRODUTOS (Título ou Autor)
        // 'with' carrega os relacionamentos para não dar erro na view
        $products = Product::with(['author', 'genre', 'publisher'])
            ->where('titulo', 'like', "%{$query}%")
            ->orWhereHas('author', function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->get();

        // 3. Busca em USUÁRIOS (Nome ou Email)
        $users = User::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->get();

        // 4. Retorna a View com os dois resultados
        return view('admin.search_results', compact('products', 'users', 'query'));
    }
}
