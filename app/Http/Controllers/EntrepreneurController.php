<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Contrôleur EntrepreneurController
 *
 * Gère les actions liées à l'entrepreneur :
 * - Affichage du dashboard après approbation
 * - Affichage de la page d'attente si l'entrepreneur n'est pas encore approuvé
 */
class EntrepreneurController extends Controller
{
    /**
     * Affiche le tableau de bord de l'entrepreneur approuvé.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function dashboard()
    {
        $user = auth()->user(); // Récupère l'utilisateur connecté
        $stand = $user->stand;  // Récupère le stand associé

        return view('entrepreneur.dashboard', compact('user', 'stand'));
    }

    /**
     * Affiche la page d'attente pour les entrepreneurs en attente d'approbation.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function pending()
    {
        return view('entrepreneur.pending');
    }
}
