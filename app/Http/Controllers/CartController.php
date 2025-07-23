<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        return view('public.cart.index', compact('cart'));
    }

    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = session('cart', []);
        $qty = (int) $request->input('quantite', 1);
        if ($qty < 1) $qty = 1;
        // Optionnel : gestion du stock ici
        if (isset($cart[$productId])) {
            $cart[$productId]['quantite'] += $qty;
        } else {
            $cart[$productId] = [
                'product_id' => $product->id,
                'nom' => $product->nom,
                'prix' => $product->prix,
                'photo' => $product->photo,
                'quantite' => $qty,
            ];
        }
        session(['cart' => $cart]);
        return redirect()->back()->with('success', 'Produit ajouté au panier.');
    }

    public function update(Request $request, $productId)
    {
        $cart = session('cart', []);
        if (isset($cart[$productId])) {
            $qty = (int) $request->input('quantite', 1);
            if ($qty < 1) $qty = 1;
            $cart[$productId]['quantite'] = $qty;
            session(['cart' => $cart]);
        }
        return redirect()->route('cart.index');
    }

    public function remove($productId)
    {
        $cart = session('cart', []);
        unset($cart[$productId]);
        session(['cart' => $cart]);
        return redirect()->route('cart.index');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index');
    }
} 