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

        // Pega o carrinho atual da sessão (ou cria um array vazio se não existir)
        $cart = session()->get('cart', []);

        // Se o produto já está no carrinho, aumenta a quantidade
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Se não está, adiciona ele com quantidade 1
            $cart[$id] = [
                "name" => $product->titulo,
                "quantity" => 1,
                "price" => $product->preco,
                "image" => $product->imagem
            ];
        }

        // Salva o carrinho atualizado na sessão
        session()->put('cart', $cart);

        return redirect()->back()->with('sucesso', 'Produto adicionado ao carrinho!');
    }

    // 3. Remover Item do Carrinho
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
    }
    
    // 4. Atualizar Quantidade (Ajax - Opcional para depois)
    // Vamos focar no básico primeiro
}