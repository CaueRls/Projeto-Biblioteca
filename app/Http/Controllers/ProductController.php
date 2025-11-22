<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Publisher;

class ProductController extends Controller
{
    /**
     * Lista todos os produtos na tabela.
     */
    public function index()
    {
        // Busca todos os produtos
        // DICA: Se você já definiu os relacionamentos no Model, poderia usar Product::with('author', ...)->get();
        $products = Product::all();
        
        return view('admin.produtos.index', compact('products'));
    }

    /**
     * Mostra o formulário de cadastro.
     * Agora buscamos as listas do Banco de Dados para preencher os <select>.
     */
    public function create()
    {
        $autores = Author::all();    // SELECT * FROM authors
        $generos = Genre::all();     // SELECT * FROM genres
        $editoras = Publisher::all(); // SELECT * FROM publishers

        // Passamos essas variáveis para a view
        return view('admin.produtos.create', compact('autores', 'generos', 'editoras'));
    }

    /**
     * Salva o novo produto no Banco.
     */
    public function store(Request $request)
    {
        // Pega todos os dados
        $data = $request->all();
        
        // Se o checkbox não vier marcado, define como 0 (false)
        $data['is_featured'] = $request->has('is_featured');

        Product::create($data); // Salva com a variável $data ajustada

        return redirect()->route('admin.produtos.index')->with('sucesso', 'Criado!');
    }
    /**
     * Mostra o formulário de edição.
     * Precisamos do produto atual E das listas para os dropdowns.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        
        // Precisamos carregar as listas novamente para o usuário poder trocar a opção
        $autores = Author::all();
        $generos = Genre::all();
        $editoras = Publisher::all();

        return view('admin.produtos.edit', compact('product', 'autores', 'generos', 'editoras'));
    }

    /**
     * Atualiza os dados no Banco.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $data = $request->all();
        $data['is_featured'] = $request->has('is_featured'); // Ajuste do checkbox

        $product->update($data);

        return redirect()->route('admin.produtos.index')->with('sucesso', 'Atualizado!');
    }

    /**
     * Remove o produto.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.produtos.index')
                         ->with('sucesso', 'Produto excluído com sucesso!');
    }
}