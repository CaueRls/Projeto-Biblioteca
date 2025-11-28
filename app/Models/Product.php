<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'titulo', 
    'sinopse', // <--- ADICIONE AQUI
    'author_id', 
    'genre_id', 
    'publisher_id', 
    'imagem', 
    'preco', 
    'is_featured'
    ];

    // Relação: Um produto PERTENCE a um Autor
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Relação: Um produto PERTENCE a um Gênero
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    // Relação: Um produto PERTENCE a uma Editora
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}