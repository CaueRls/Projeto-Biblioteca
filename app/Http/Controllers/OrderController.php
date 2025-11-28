<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // Busca os pedidos do usuário logado, com os itens e os produtos dentro dos itens
        // latest() ordena do mais recente para o mais antigo
        $orders = Order::where('user_id', Auth::id())
                       ->with('items.product') 
                       ->latest()
                       ->get();

        return view('orders.index', compact('orders'));
    }
}