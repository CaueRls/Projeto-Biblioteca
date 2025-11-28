<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // Um item pertence a um pedido
    public function order() {
        return $this->belongsTo(Order::class);
    }

    // Um item representa um produto (livro)
    public function product() {
        return $this->belongsTo(Product::class);
    }
}