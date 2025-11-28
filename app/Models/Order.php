<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total_price', 'status'];

    // Um pedido tem muitos itens
    public function items() {
        return $this->hasMany(OrderItem::class);
    }
    
    // Um pedido pertence a um usuário
    public function user() {
        return $this->belongsTo(User::class);
    }
}