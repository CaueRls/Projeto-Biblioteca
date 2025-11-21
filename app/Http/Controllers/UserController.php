<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    // --- PARTE DE REGISTRO ---
    public function showRegisterForm() {
        return view('RegistroUsuario');
    }

    public function register(Request $request) {
        // 1. Validar os dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users', // garante email único
            'password' => 'required|min:6|confirmed', // confirmed exige um campo password_confirmation no form
        ]);

        // 2. Criar o usuário no Banco
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Criptografa a senha
        ]);

        // 3. Logar automaticamente e redirecionar
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('livros.index'); // Redireciona para o acervo
        }

        return redirect('/');
    }

    // --- PARTE DE LOGIN ---
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        // 1. Validar
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Tentar Logar (O Laravel checa o hash da senha sozinho aqui)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Segurança contra fixação de sessão
            return redirect()->intended('acervo'); // Vai para onde tentou ir ou para o acervo
        }

        // 3. Se falhar, volta com erro
        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ])->onlyInput('email');
    }

    // --- LOGOUT ---
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}