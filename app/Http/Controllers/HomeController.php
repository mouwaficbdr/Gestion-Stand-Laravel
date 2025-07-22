<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Contrôleur HomeController
 *
 * Gère l'affichage de la page d'accueil de l'événement.
 */
class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil de l'événement.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('home');
    }
}
