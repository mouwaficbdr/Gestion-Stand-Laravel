<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

/**
 * Contrôleur PasswordResetLinkController
 *
 * Gère la demande de lien de réinitialisation de mot de passe :
 * - Affichage du formulaire de demande
 * - Envoi du lien de réinitialisation
 */
class PasswordResetLinkController extends Controller
{
    /**
     * Affiche le formulaire de demande de lien de réinitialisation de mot de passe.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Traite la demande d'envoi du lien de réinitialisation de mot de passe.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Envoie le lien de réinitialisation à l'utilisateur
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}
