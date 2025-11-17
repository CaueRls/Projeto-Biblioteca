<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{

    use HasFactory;
    protected $table = 'books';

    protected $fillable = [
        'isbn',
        'title',
        'author',
        'release_date',
        'description',
        'publisher',
        'page_number',
        'category_id',
    ];

    public function category()
    {
        // Usa 'category_id' como chave estrangeira por padrão
        return $this->belongsTo(category::class);
    }

    /**
     * Relação Many-to-Many: Um Livro tem muitas Tags.
     */
    public function tags()
    {
        // O Laravel usa a tabela pivô 'book_tag' por convenção
        return $this->belongsToMany(tag::class, 'book_tag', 'book_id', 'tag_id');
    }
}


