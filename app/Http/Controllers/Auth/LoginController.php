<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * Contrôleur LoginController
 *
 * Gère l'authentification des utilisateurs :
 * - Affichage du formulaire de connexion
 * - Traitement de la connexion
 * - Déconnexion
 */
class LoginController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Traite la tentative de connexion de l'utilisateur.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validation des champs du formulaire
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => "L'email est obligatoire.",
            'email.email' => "L'email doit être valide.",
            'password.required' => "Le mot de passe est obligatoire.",
        ]);

        if ($validator->fails()) {
            // Retourne en arrière avec les erreurs de validation
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Tente de connecter l'utilisateur
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Redirige selon le rôle de l'utilisateur
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->isPending()) {
                return redirect()->route('entrepreneur.pending');
            } elseif ($user->isApprovedEntrepreneur()) {
                return redirect()->route('entrepreneur.dashboard');
            }
        }

        // Identifiants incorrects
        return redirect()->back()
            ->withErrors(['email' => 'Identifiants incorrects.'])
            ->withInput();
    }

    /**
     * Déconnecte l'utilisateur et le redirige vers la page d'accueil.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
