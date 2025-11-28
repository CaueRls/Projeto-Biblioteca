<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;      // <--- IMPORTANTE
use App\Models\OrderItem;  // <--- IMPORTANTE
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // 1. Mostrar a tela de Checkout
    public function index()
    {
        // Se o carrinho estiver vazio, manda de volta pra loja
        if(!session('cart') || count(session('cart')) == 0) {
            return redirect()->route('home')->with('erro', 'Seu carrinho está vazio!');
        }

        return view('checkout.index');
    }

    // 2. Processar o Pedido (Simulação)
    public function store(Request $request)
    {
        $cart = session('cart');
        $total = 0;

        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 1. Criar o Pedido Principal
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'Pago', // Simulando pagamento aprovado
        ]);

        // 2. Criar os Itens do Pedido
        foreach($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        // 3. Limpar Carrinho
        session()->forget('cart');

        // 4. Redirecionar para a página de Meus Pedidos
        return redirect()->route('orders.index')->with('sucesso', 'Pedido #' . $order->id . ' realizado com sucesso!');
    }
}