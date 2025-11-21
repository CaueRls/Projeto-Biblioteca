<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
});

Route::get('/registrar', [UserController::class, 'showRegisterForm'])
    ->name('register'); // <--- ESSE É O APELIDO QUE IMPORTA

// Rotas para Visitantes (Quem NÃO está logado)
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.submit');
    
    Route::get('/registrar', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/registrar', [UserController::class, 'register'])->name('register.submit');
});

// Rota de Logout (Só quem está logado pode sair)
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');