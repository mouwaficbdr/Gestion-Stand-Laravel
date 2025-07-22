<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stand;

/**
 * Contrôleur StandController
 *
 * Gère l'affichage de la liste des stands.
 */
class StandController extends Controller
{
    /**
     * Affiche la liste de tous les stands.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $stands = Stand::all(); // Récupère tous les stands
        return view('stands.index', compact('stands'));
    }
}
