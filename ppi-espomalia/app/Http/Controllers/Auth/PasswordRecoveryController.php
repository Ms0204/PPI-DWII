<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PasswordRecoveryController extends Controller
{
    public function recover(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Simular envío (puedes integrar Mail:: más adelante)
        // Aquí puedes implementar lógica real para enviar un correo
        return redirect()->back()->with('success', 'La contraseña ha sido enviada a su correo electrónico.');
    }
}
