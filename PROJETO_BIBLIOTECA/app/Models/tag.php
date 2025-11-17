<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;

    protected $table = 'tags';
    
    // Campo preenchível
    protected $fillable = ['name'];

    /**
     * Relação Many-to-Many: Uma Tag pertence a muitos Livros.
     */
    public function books()
    {
        // Relação inversa. Usa a tabela pivô 'book_tag'
        return $this->belongsToMany(book::class, 'book_tag', 'tag_id', 'book_id');
    }
}
