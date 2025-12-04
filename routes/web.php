<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AdminSearchController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
// --- PÁGINA INICIAL ---
Route::get('/', [HomeController::class, 'index'])->name('home');

// --- ACERVO ---
Route::get('/acervo', [HomeController::class, 'index'])->name('livros.index');
Route::get('/livro/{id}', [HomeController::class, 'show'])->name('product.show');

// --- AUTENTICAÇÃO (GUEST - APENAS VISITANTES) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.submit');
    
    Route::get('/registrar', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/registrar', [UserController::class, 'register'])->name('register.submit');

    // Rotas de Esqueci a Senha
    Route::get('/esqueci-senha', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/esqueci-senha', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('/redefinir-senha/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/redefinir-senha', [ResetPasswordController::class, 'reset'])->name('password.update');

});

// --- LOGOUT (APENAS LOGADOS) ---
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');


// GRUPO DE ADMINISTRAÇÃO
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
    
    // Pesquisa Global
    Route::get('/search', [AdminSearchController::class, 'search'])->name('admin.search');
});

Route::get('carrinho', [CartController::class, 'index'])->name('cart.index');
Route::post('adicionar-ao-carrinho/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('remover-do-carrinho', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/finalizar', [CheckoutController::class, 'store'])->name('checkout.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/meus-pedidos', [OrderController::class, 'index'])->name('orders.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/favoritos', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favoritos/toggle/{id}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
});