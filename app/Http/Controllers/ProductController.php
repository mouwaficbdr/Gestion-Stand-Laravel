<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Auth::user()->products()->latest()->paginate(8);
        return view('entrepreneur.products.index', compact('products'));
    }

    public function create()
    {
        return view('entrepreneur.products.create');
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('products', 'public');
        }
        Product::create($data);
        return redirect()->route('entrepreneur.products.index')->with('success', 'Produit ajouté avec succès.');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        return view('entrepreneur.products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            if ($product->photo && Storage::disk('public')->exists($product->photo)) {
                Storage::disk('public')->delete($product->photo);
            }
            $data['photo'] = $request->file('photo')->store('products', 'public');
        }
        $product->update($data);
        return redirect()->route('entrepreneur.products.index')->with('success', 'Produit modifié avec succès.');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        return redirect()->route('entrepreneur.products.index')->with('success', 'Produit supprimé avec succès.');
    }
} 