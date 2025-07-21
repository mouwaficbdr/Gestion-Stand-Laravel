<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Afficher la page d'accueil de l'événement
     */
    public function index()
    {
        return view('home');
    }
}
