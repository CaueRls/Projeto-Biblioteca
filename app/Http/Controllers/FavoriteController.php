<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // 1. Listar Favoritos
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())
                             ->with('product.author') // Carrega produto e autor
                             ->get();
                             
        return view('favorites.index', compact('favorites'));
    }

    // 2. Adicionar/Remover (Toggle)
    public function toggle($productId)
    {
        $userId = Auth::id();
        
        // Verifica se já existe
        $favorite = Favorite::where('user_id', $userId)
                            ->where('product_id', $productId)
                            ->first();

        if ($favorite) {
            // Se já existe, remove
            $favorite->delete();
            $message = 'Produto removido dos favoritos!';
        } else {
            // Se não existe, cria
            Favorite::create([
                'user_id' => $userId,
                'product_id' => $productId
            ]);
            $message = 'Produto adicionado aos favoritos!';
        }

        return back()->with('sucesso', $message);
    }
}