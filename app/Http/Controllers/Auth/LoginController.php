<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Afficher le formulaire de connexion
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Traiter la connexion
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Redirection selon le rôle
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->isPending()) {
                return redirect()->route('entrepreneur.pending');
            } elseif ($user->isApprovedEntrepreneur()) {
                return redirect()->route('entrepreneur.dashboard');
            }
        }

        return redirect()->back()
            ->withErrors(['email' => 'Identifiants incorrects.'])
            ->withInput();
    }

    /**
     * Déconnexion
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
