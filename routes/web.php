<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;


// --- PÁGINA INICIAL ---
Route::get('/', [HomeController::class, 'index'])->name('home');

// --- ACERVO ---
Route::get('/acervo', [HomeController::class, 'index'])->name('livros.index');

// --- AUTENTICAÇÃO (GUEST - APENAS VISITANTES) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.submit');
    
    Route::get('/registrar', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/registrar', [UserController::class, 'register'])->name('register.submit');
});

// --- LOGOUT (APENAS LOGADOS) ---
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');


// GRUPO DE ADMINISTRAÇÃO
// Middleware 'auth' = Precisa estar logado
// Middleware 'admin' = Precisa ser is_admin = 1
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Produtos
    Route::get('/produtos', [ProductController::class, 'index'])->name('admin.produtos.index');
    Route::get('/produtos/novo', [ProductController::class, 'create'])->name('admin.produtos.create');
    Route::post('/produtos/salvar', [ProductController::class, 'store'])->name('admin.produtos.store');
    Route::get('/produtos/{id}/editar', [ProductController::class, 'edit'])->name('admin.produtos.edit');
    Route::put('/produtos/{id}', [ProductController::class, 'update'])->name('admin.produtos.update');
    Route::delete('/produtos/{id}', [ProductController::class, 'destroy'])->name('admin.produtos.destroy');

    // Usuários
    Route::get('/usuarios', [UserController::class, 'index'])->name('admin.users.index');
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::patch('/usuarios/{id}/status', [UserController::class, 'toggleStatus'])->name('admin.users.toggle');

});