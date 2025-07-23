<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stand;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Dashboard administrateur
     */
    public function dashboard()
    {
        $demandesEnAttente = User::where('role', 'entrepreneur_en_attente')
            ->with('stand')
            ->get();
        
        $entrepreneursApprouves = User::where('role', 'entrepreneur_approuve')
            ->with('stand')
            ->get();

        return view('admin.dashboard', compact('demandesEnAttente', 'entrepreneursApprouves'));
    }

    /**
     * Liste des demandes de stand
     */
    public function demandes()
    {
        $demandes = User::where('role', 'entrepreneur_en_attente')
            ->with('stand')
            ->paginate(10);

        return view('admin.demandes', compact('demandes'));
    }

    /**
     * Approuver une demande
     */
    public function approuverDemande($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role !== 'entrepreneur_en_attente') {
            return redirect()->back()->with('error', 'Cette demande ne peut pas être approuvée.');
        }

        $user->update(['role' => 'entrepreneur_approuve']);

        //Envoyer email de notification
        
        return redirect()->back()->with('success', 'Demande approuvée avec succès.');
    }

    /**
     * Rejeter une demande
     */
    public function rejeterDemande(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role !== 'entrepreneur_en_attente') {
            return redirect()->back()->with('error', 'Cette demande ne peut pas être rejetée.');
        }

        $request->validate([
            'motif_rejet' => 'required|string|max:255',
        ]);

        // Enregistrer le motif de rejet
        $user->motif_rejet = $request->motif_rejet;
        $user->save();

        // Supprimer l'utilisateur et son stand
        $user->delete();

        //Envoyer email de notification avec motif
        
        return redirect()->back()->with('success', 'Demande rejetée avec succès.');
    }

    /**
     * Retirer l'approbation d'un stand
     */
    public function retirerApprobation(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role !== 'entrepreneur_approuve') {
            return redirect()->back()->with('error', 'Ce stand n\'est pas approuvé.');
        }

        $request->validate([
            'motif_retrait' => 'required|string|max:255',
        ]);

        // Changer le statut vers en attente et enregistrer le motif
        $user->update([
            'role' => 'entrepreneur_en_attente',
            'motif_retrait' => $request->motif_retrait
        ]);

        // Envoyer email de notification avec motif
        
        return redirect()->back()->with('success', 'Approbation retirée avec succès. Le stand est maintenant en attente.');
    }

    /**
     * Liste des stands
     */
    public function stands(Request $request)
    {
        $query = Stand::with('utilisateur');

        // Filtrage par statut
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
