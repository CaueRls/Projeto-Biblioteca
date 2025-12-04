<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    // 1. Mostrar o formulário de "Esqueci minha senha"
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // 2. Enviar o link por e-mail (ou log)
    public function sendResetLinkEmail(Request $request)
    {
        // Valida se o email foi preenchido e se é um email válido
        $request->validate(['email' => 'required|email']);

        // Tenta enviar o link
        // O Laravel cuida de gerar o token e salvar no banco automaticamente
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['status' => __($status)]);
        }

        return back()->withErrors(['email' => __($status)]);
    }
}