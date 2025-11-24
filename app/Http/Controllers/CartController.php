<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // 1. Exibir o Carrinho
    public function index()
    {
        return view('cart.index');
    }

    // 2. Adicionar Item ao Carrinho
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        // Pega o carrinho atual da sessão
        $cart = session()->get('cart', []);

        // Se já existe, aumenta quantidade
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Se não, adiciona novo
            $cart[$id] = [
                "name" => $product->titulo,
                "quantity" => 1,
                "price" => $product->preco,
                "image" => $product->imagem
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('sucesso', 'Produto adicionado ao carrinho!');
    }

    // 3. Remover Item do Carrinho (A CORREÇÃO ESTÁ AQUI)
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            
            session()->flash('sucesso', 'Produto removido com sucesso!');
        }

        // !!! ESSA LINHA ERA A QUE FALTAVA !!!
        // Ela manda o navegador voltar para a página anterior (o carrinho)
        return redirect()->back();
    }
}