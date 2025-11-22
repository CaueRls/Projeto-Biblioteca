<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

// --- PÁGINA INICIAL ---
Route::get('/', function () {
    return view('home');
});

// --- ACERVO ---
Route::get('/acervo', function () {
    return view('home'); 
})->name('livros.index');


// --- AUTENTICAÇÃO (GUEST - APENAS VISITANTES) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.submit');
    
    Route::get('/registrar', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/registrar', [UserController::class, 'register'])->name('register.submit');
});

// --- LOGOUT (APENAS LOGADOS) ---
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');


// ==========================================================
// ADMINISTRAÇÃO DE PRODUTOS
// ==========================================================

// Listar
Route::get('/admin/produtos', [ProductController::class, 'index'])->name('admin.produtos.index');

// Criar
Route::get('/admin/produtos/novo', [ProductController::class, 'create'])->name('admin.produtos.create');
Route::post('/admin/produtos/salvar', [ProductController::class, 'store'])->name('admin.produtos.store');

// Editar
Route::get('/admin/produtos/{id}/editar', [ProductController::class, 'edit'])->name('admin.produtos.edit');
Route::put('/admin/produtos/{id}', [ProductController::class, 'update'])->name('admin.produtos.update');

// Excluir
Route::delete('/admin/produtos/{id}', [ProductController::class, 'destroy'])->name('admin.produtos.destroy');


// ==========================================================
// ADMINISTRAÇÃO DE USUÁRIOS (NOVO!)
// ==========================================================
// Essas eram as rotas que faltavam para o seu UserController funcionar no admin
Route::get('/admin/usuarios', [UserController::class, 'index'])->name('admin.users.index');
Route::delete('/admin/usuarios/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
Route::patch('/admin/usuarios/{id}/status', [UserController::class, 'toggleStatus'])->name('admin.users.toggle');