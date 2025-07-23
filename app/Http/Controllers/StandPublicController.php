<?php

namespace App\Http\Controllers;

use App\Models\Stand;
use Illuminate\Http\Request;

class StandPublicController extends Controller
{
    public function index()
    {
        $stands = Stand::whereHas('utilisateur', function($q) {
            $q->where('role', 'entrepreneur_approuve');
        })->with('utilisateur')->paginate(12);
        return view('public.stands.index', compact('stands'));
    }

    public function show($id)
    {
        $stand = Stand::with(['utilisateur', 'utilisateur.products'])->findOrFail($id);
        if (!$stand->utilisateur || $stand->utilisateur->role !== 'entrepreneur_approuve') {
            abort(404);
        }
        $products = $stand->utilisateur->products;
        
        // Récupérer 3 autres stands aléatoires (excluant le stand actuel)
        $relatedStands = Stand::whereHas('utilisateur', function($q) {
            $q->where('role', 'entrepreneur_approuve');
        })
        ->where('id', '!=', $id)
        ->with('utilisateur')
        ->inRandomOrder()
        ->limit(3)
        ->get();
        
        return view('public.stands.show', compact('stand', 'products', 'relatedStands'));
    }
} 