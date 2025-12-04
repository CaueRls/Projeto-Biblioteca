<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // <--- Importante: O Model User precisa estar aqui

class UserController extends Controller
{
    // ==========================================================
    // PARTE 1: REGISTRO (CRIAR CONTA)
    // ==========================================================
    
    public function showRegisterForm() {
        // Se você mudou o nome do arquivo blade, ajuste aqui.
        // Se estiver na pasta auth: 'auth.register'
        // Se estiver solto: 'RegistroUsuario'
        return view('registroUsuario'); 
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('livros.index');
        }

        return redirect('/');
    }

    // ==========================================================
    // PARTE 2: LOGIN
    // ==========================================================

    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // ADICIONAMOS A CONDIÇÃO 'is_active' => 1 AQUI:
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => 1])) {
            $request->session()->regenerate();
            return redirect()->intended('acervo');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas ou conta desativada.',
        ])->onlyInput('email');
    }

    // ==========================================================
    // PARTE 3: LOGOUT
    // ==========================================================

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // ==========================================================
    // PARTE 4: ADMINISTRAÇÃO (LISTAR E EXCLUIR) - O QUE FALTAVA
    // ==========================================================

    public function index()
    {
        // Busca todos os usuários
        $users = User::all();
        // Retorna a view da lista de usuários
        return view('admin.usuarios.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('sucesso', 'Usuário excluído com sucesso!');
    }

    // Função para Ativar/Desativar usuário
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        
        // Inverte o status atual (Se é true vira false, se é false vira true)
        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('sucesso', 'Status do usuário alterado com sucesso!');
    }
}
