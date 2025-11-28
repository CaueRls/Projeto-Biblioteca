<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Carrossel: Pega apenas os 5 primeiros destaques
        $destaques = Product::with(['author', 'genre', 'publisher'])
            ->where('is_featured', true)
            ->take(5)
            ->get();

        // 2. Inicia a Query dos Livros para a lista
        $query = Product::with(['author', 'genre', 'publisher'])->orderByDesc('id');

        // 3. Se houver pesquisa, aplica os filtros
        if ($request->filled('search')) {
            $termo = $request->input('search');

            $query->where(function($q) use ($termo) {
                $q->where('titulo', 'like', "%{$termo}%")
                  ->orWhereHas('author', function($q) use ($termo) {
                      $q->where('name', 'like', "%{$termo}%");
                  })
                  ->orWhereHas('genre', function($q) use ($termo) {
                      $q->where('name', 'like', "%{$termo}%");
                  });
            });
        }

        // 4. Executa com paginação (12 por página)
        $livros = $query->paginate(12)->withQueryString();

        return view('home', compact('livros', 'destaques'));
    }

    public function show($id)
    {
        // Busca o livro com os relacionamentos
        $product = Product::with(['author', 'genre', 'publisher'])->findOrFail($id);

        return view('product.show', compact('product'));
    }
}