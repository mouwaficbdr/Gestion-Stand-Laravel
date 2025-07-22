<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Contrôleur EmailVerificationNotificationController
 *
 * Gère l'envoi d'un nouvel email de vérification à l'utilisateur.
 */
class EmailVerificationNotificationController extends Controller
{
    /**
     * Envoie un nouvel email de vérification si l'utilisateur n'est pas encore vérifié.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
