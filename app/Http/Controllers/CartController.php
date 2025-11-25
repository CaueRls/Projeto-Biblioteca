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
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        
        // Define a quantidade: Se veio do formulário, usa ela. Se não, usa 1 (padrão).
        $qtd = $request->input('quantity', 1);

        // Garante que seja um número inteiro positivo
        $qtd = max(1, intval($qtd));

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $qtd; // Soma a quantidade escolhida
        } else {
            $cart[$id] = [
                "name" => $product->titulo,
                "quantity" => $qtd, // Usa a quantidade escolhida
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