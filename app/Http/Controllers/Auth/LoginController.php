<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Assurez-vous d'avoir cette vue
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/');
 // Redirection après connexion
        }

        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
