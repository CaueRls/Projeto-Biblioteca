<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    
    // Campo preenchível
    protected $fillable = ['name'];

    /**
     * Relação One-to-Many: Uma Categoria tem muitos Livros.
     */
    public function books()
    {
        // Define que os livros usam o 'category_id' para ligar a esta tabela.
        return $this->hasMany(book::class, 'category_id');
    }
}
