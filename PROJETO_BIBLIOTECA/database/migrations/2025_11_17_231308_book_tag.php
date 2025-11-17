<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        // Convenção Laravel: nomes dos Models singulares, em ordem alfabética, separados por underscore.
        Schema::create('book_tag', function (Blueprint $table) {
        $table->unsignedBigInteger('book_id');
            // Coluna para o ID da Tag
        $table->unsignedBigInteger('tag_id');

        // Definindo a chave primária composta (evita duplicidade de ligações)
        $table->primary(['book_id', 'tag_id']); 

        // Definição da Chave Estrangeira: liga ao livro
        $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        
        // Definição da Chave Estrangeira: liga à tag
        $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
