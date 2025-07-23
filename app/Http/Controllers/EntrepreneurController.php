<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntrepreneurController extends Controller
{
    /**
     * Dashboard entrepreneur (après approbation)
     */
    public function dashboard()
    {
        $user = auth()->user();
        $stand = $user->stand;

        return view('entrepreneur.dashboard', compact('user', 'stand'));
    }

    /**
     * Page d'attente pour les entrepreneurs en attente
     */
    public function pending()
    {
        return view('entrepreneur.pending');
    }
}
