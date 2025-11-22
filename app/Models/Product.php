<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Libera esses campos para serem salvos
    protected $fillable = [
    'titulo', 
    'author_id',    // Mudou de autor para author_id
    'genre_id',     // Mudou de genero para genre_id
    'publisher_id', // Mudou de editora para publisher_id
    'imagem', 
    'preco'
    ];
}