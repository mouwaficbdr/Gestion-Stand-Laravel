<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stand;
use Illuminate\Http\Request;

/**
 * Contrôleur AdminController
 *
 * Ce contrôleur gère toutes les actions liées à l'administration :
 * - Affichage du dashboard
 * - Gestion des demandes de stands
 * - Approbation et rejet des entrepreneurs
 * - Gestion et filtrage des stands
 */
class AdminController extends Controller
{
    /**
     * Affiche le tableau de bord de l'administrateur avec les demandes en attente et les entrepreneurs approuvés.
     */
    public function dashboard()
    {
        // Récupère les utilisateurs en attente avec leur stand
        $demandesEnAttente = User::where('role', 'entrepreneur_en_attente')
            ->with('stand')
            ->get();
        
        // Récupère les entrepreneurs approuvés avec leur stand
        $entrepreneursApprouves = User::where('role', 'entrepreneur_approuve')
            ->with('stand')
            ->get();

        // Affiche la vue dashboard admin
        return view('admin.dashboard', compact('demandesEnAttente', 'entrepreneursApprouves'));
    }

    /**
     * Affiche la liste paginée des demandes de stands en attente.
     */
    public function demandes()
    {
        $demandes = User::where('role', 'entrepreneur_en_attente')
            ->with('stand')
            ->paginate(10);

        return view('admin.demandes', compact('demandes'));
    }

    /**
     * Approuve une demande d'entrepreneur en attente.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approuverDemande($id)
    {
        $user = User::findOrFail($id);
        
        // Vérifie que l'utilisateur est bien en attente
        if ($user->role !== 'entrepreneur_en_attente') {
            return redirect()->back()->with('error', 'Cette demande ne peut pas être approuvée.');
        }

        // Met à jour le rôle de l'utilisateur
        $user->update(['role' => 'entrepreneur_approuve']);

        // TODO : Envoyer un email de notification à l'utilisateur
        
        return redirect()->back()->with('success', 'Demande approuvée avec succès.');
    }

    /**
     * Rejette une demande d'entrepreneur en attente et supprime l'utilisateur.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rejeterDemande(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Vérifie que l'utilisateur est bien en attente
        if ($user->role !== 'entrepreneur_en_attente') {
            return redirect()->back()->with('error', 'Cette demande ne peut pas être rejetée.');
        }

        // Supprime l'utilisateur et son stand associé
        $user->delete();

        // TODO : Envoyer un email de notification avec le motif du rejet
        
        return redirect()->back()->with('success', 'Demande rejetée avec succès.');
    }

    /**
     * Affiche la liste paginée des stands avec possibilité de filtrer par statut.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function stands(Request $request)
    {
        $query = Stand::with('utilisateur');

        // Filtrage par statut du propriétaire du stand
        if ($request->has('statut') && $request->statut !== '') {
            if ($request->statut === 'approuve') {
                $query->whereHas('utilisateur', function($q) {
                    $q->where('role', 'entrepreneur_approuve');
                });
            } elseif ($request->statut === 'en_attente') {
                $query->whereHas('utilisateur', function($q) {
                    $q->where('role', 'entrepreneur_en_attente');
                });
            }
        }

        $stands = $query->paginate(10);

        return view('admin.stands', compact('stands'));
    }
}
