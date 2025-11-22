<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Busca apenas os livros marcados como destaque (is_featured = 1)
        $destaques = Product::with(['author', 'genre'])->where('is_featured', true)->get();

        // 2. Busca todos os livros para a lista de baixo (ou apenas os que NÃO são destaque, você escolhe)
        $livros = Product::with(['author', 'genre'])->get();

        return view('home', compact('livros', 'destaques'));
    }
}