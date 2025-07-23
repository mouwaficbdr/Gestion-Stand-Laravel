<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Stand;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function create($standId)
    {
        $cart = session('cart', []);
        $stand = Stand::findOrFail($standId);
        // Filtrer le panier pour ce stand uniquement
        $cart = array_filter($cart, function($item) use ($stand) {
            return $item['product_id'] && $stand->utilisateur->products->contains('id', $item['product_id']);
        });
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier pour ce stand est vide.');
        }
        $total = array_reduce($cart, function($carry, $item) {
            return $carry + $item['prix'] * $item['quantite'];
        }, 0);
        return view('public.order.create', compact('cart', 'stand', 'total'));
    }

    public function store(OrderRequest $request, $standId)
    {
        $cart = session('cart', []);
        $stand = Stand::findOrFail($standId);
        // Filtrer le panier pour ce stand uniquement
        $cart = array_filter($cart, function($item) use ($stand) {
            return $item['product_id'] && $stand->utilisateur->products->contains('id', $item['product_id']);
        });
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier pour ce stand est vide.');
        }
        if ($request->filled('honeypot')) {
            return redirect()->route('cart.index'); // anti-spam
        }
        $total = array_reduce($cart, function($carry, $item) {
            return $carry + $item['prix'] * $item['quantite'];
        }, 0);
        DB::beginTransaction();
        $order = Order::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'stand_id' => $stand->id,
            'total' => $total,
            'honeypot' => $request->honeypot,
        ]);
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantite' => $item['quantite'],
                'prix' => $item['prix'],
            ]);
        }
        DB::commit();
        // Vider le panier pour ce stand
        foreach ($cart as $item) {
            unset($cart[$item['product_id']]);
        }
        session(['cart' => $cart]);
        return redirect()->route('order.confirmation', $order->order_number);
    }

    public function confirmation($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('items.product', 'stand')->firstOrFail();
        return view('public.order.confirmation', compact('order'));
    }
} 