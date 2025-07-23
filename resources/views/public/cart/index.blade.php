@extends('layouts.app')

@section('title', 'Mon Panier - Eat&Drink')
@section('description', 'Consultez et gérez les produits de votre panier avant de passer commande')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-accent-50">
    <!-- Header -->
    <div class="bg-white shadow-soft border-b border-secondary-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-display font-bold text-secondary-900 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-primary-500 to-accent-500 rounded-xl flex items-center justify-center mr-3 shadow-glow">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        Mon Panier
                    </h1>
                    <p class="text-secondary-600 mt-1">
                        @if(!empty($cart))
                            {{ count($cart) }} {{ count($cart) > 1 ? 'articles' : 'article' }} dans votre panier
                        @else
                            Votre panier est vide
                        @endif
                    </p>
                </div>
                
                @if(!empty($cart))
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('stands.public.index') }}" 
                           class="btn btn-secondary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Continuer mes achats
                        </a>
                        
                        <form action="{{ route('cart.clear') }}" method="POST" class="inline" x-data="{ clearing: false }">
                            @csrf
                            <button type="submit" 
                                    :disabled="clearing"
                                    @click="clearing = true; return confirm('Êtes-vous sûr de vouloir vider votre panier ?')"
                                    class="btn btn-danger">
                                <span x-show="!clearing" class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Vider le panier
                                </span>
                                <span x-show="clearing" class="flex items-center">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Suppression...
                                </span>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(!empty($cart))
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-4">
                    @php 
                        $total = 0; 
                        $standIds = [];
                        $standNames = [];
                    @endphp
                    
                    @foreach($cart as $item)
                        @php
                            $total += $item['prix'] * $item['quantite'];
                            $product = \App\Models\Product::find($item['product_id']);
                            $standId = $product->user->stand->id ?? null;
                            $standName = $product->user->stand->nom_stand ?? 'Stand inconnu';
                            $standIds[$item['product_id']] = $standId;
                            $standNames[$standId] = $standName;
                        @endphp
                        
                        <div class="card card-hover" x-data="{ updating: false, removing: false }">
                            <div class="card-body p-6">
                                <div class="flex items-start space-x-4">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0">
                                        <div class="w-20 h-20 bg-gradient-to-br from-secondary-100 to-secondary-200 rounded-xl overflow-hidden">
                                            @if($item['photo'])
                                                <img src="{{ asset('storage/' . $item['photo']) }}" 
                                                     alt="{{ $item['nom'] }}" 
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Product Info -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h3 class="text-lg font-semibold text-secondary-900 mb-1">
                                                    {{ $item['nom'] }}
                                                </h3>
                                                <p class="text-sm text-secondary-600 mb-2">
                                                    Par {{ $standName }}
                                                </p>
                                                <div class="flex items-center space-x-4 text-sm text-secondary-500">
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                        </svg>
                                                        {{ number_format($item['prix'], 2, ',', ' ') }} € l'unité
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <!-- Price -->
                                            <div class="text-right">
                                                <p class="text-xl font-bold text-secondary-900">
                                                    {{ number_format($item['prix'] * $item['quantite'], 2, ',', ' ') }} €
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Quantity Controls & Actions -->
                                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-secondary-100">
                                            <!-- Quantity Controls -->
                                            <form action="{{ route('cart.update', $item['product_id']) }}" 
                                                  method="POST" 
                                                  class="flex items-center space-x-2"
                                                  @submit.prevent="
                                                    updating = true;
                                                    fetch('{{ route('cart.update', $item['product_id']) }}', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                        },
                                                        body: JSON.stringify({ 
                                                            quantite: $refs.quantity.value 
                                                        })
                                                    }).then(() => {
                                                        updating = false;
                                                        location.reload();
                                                    });
                                                  ">
                                                @csrf
                                                <div class="flex items-center border border-secondary-300 rounded-lg">
                                                    <button type="button" 
                                                            onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.dispatchEvent(new Event('change'));"
                                                            class="p-2 hover:bg-secondary-50 transition-colors duration-200">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                        </svg>
                                                    </button>
                                                    <input type="number" 
                                                           name="quantite" 
                                                           x-ref="quantity"
                                                           value="{{ $item['quantite'] }}" 
                                                           min="1" 
                                                           class="w-16 text-center border-0 focus:ring-0 text-sm py-2"
                                                           @change="$el.form.dispatchEvent(new Event('submit'))">
                                                    <button type="button" 
                                                            onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.dispatchEvent(new Event('change'));"
                                                            class="p-2 hover:bg-secondary-50 transition-colors duration-200">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                
                                                <span x-show="updating" class="text-sm text-secondary-500 flex items-center">
                                                    <svg class="animate-spin -ml-1 mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                    Mise à jour...
                                                </span>
                                            </form>

                                            <!-- Remove Button -->
                                            <form action="{{ route('cart.remove', $item['product_id']) }}" 
                                                  method="POST" 
                                                  class="inline"
                                                  @submit.prevent="
                                                    removing = true;
                                                    fetch('{{ route('cart.remove', $item['product_id']) }}', {
                                                        method: 'POST',
                                                        headers: {
                                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                        }
                                                    }).then(() => {
                                                        removing = false;
                                                        location.reload();
                                                    });
                                                  ">
                                                @csrf
                                                <button type="submit" 
                                                        :disabled="removing"
                                                        class="btn btn-danger btn-sm">
                                                    <span x-show="!removing" class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Retirer
                                                    </span>
                                                    <span x-show="removing" class="flex items-center">
                                                        <svg class="animate-spin -ml-1 mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                        Suppression...
                                                    </span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="card sticky top-24">
                        <div class="card-header">
                            <h3 class="text-lg font-semibold text-secondary-900">Récapitulatif</h3>
                        </div>
                        <div class="card-body p-6">
                            <!-- Items Summary -->
                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between text-sm">
                                    <span class="text-secondary-600">Articles ({{ count($cart) }})</span>
                                    <span class="font-medium text-secondary-900">{{ number_format($total, 2, ',', ' ') }} €</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-secondary-600">Frais de service</span>
                                    <span class="font-medium text-success-600">Gratuit</span>
                                </div>
                            </div>

                            <div class="border-t border-secondary-200 pt-4 mb-6">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-secondary-900">Total</span>
                                    <span class="text-2xl font-bold text-primary-600">{{ number_format($total, 2, ',', ' ') }} €</span>
                                </div>
                            </div>

                            <!-- Order Actions -->
                            @php
                                $uniqueStandIds = array_unique(array_values($standIds));
                                $standId = count($uniqueStandIds) === 1 ? $uniqueStandIds[0] : null;
                            @endphp
                            
                            @if($standId)
                                <a href="{{ route('order.create', $standId) }}" 
                                   class="btn btn-primary w-full py-3 text-lg font-semibold shadow-glow hover:shadow-strong mb-4">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Passer la commande
                                </a>
                                
                                <div class="text-center">
                                    <p class="text-xs text-secondary-500 mb-2">Commande auprès de :</p>
                                    <p class="text-sm font-medium text-secondary-900">{{ $standNames[$standId] }}</p>
                                </div>
                            @else
                                <div class="alert alert-warning mb-4">
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-accent-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                        </svg>
                                        <div>
                                            <p class="font-medium text-accent-800 mb-1">Commande impossible</p>
                                            <p class="text-sm text-accent-700">Votre panier contient des produits de plusieurs stands. Vous devez commander séparément pour chaque stand.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="space-y-2">
                                    @foreach($standNames as $id => $name)
                                        <a href="{{ route('order.create', $id) }}" 
                                           class="btn btn-secondary w-full py-2 text-sm">
                                            Commander chez {{ $name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Security Info -->
                            <div class="mt-6 pt-4 border-t border-secondary-200">
                                <div class="flex items-center justify-center space-x-4 text-xs text-secondary-500">
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                        Sécurisé
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                        Rapide
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                        Fiable
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart State -->
            <div class="text-center py-16">
                <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-r from-secondary-100 to-secondary-200 rounded-3xl flex items-center justify-center">
                    <svg class="w-16 h-16 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-display font-bold text-secondary-900 mb-4">Votre panier est vide</h3>
                <p class="text-xl text-secondary-600 mb-8 max-w-md mx-auto">
                    Découvrez nos exposants et leurs délicieuses créations pour commencer vos achats.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('stands.public.index') }}" 
                       class="btn btn-primary px-8 py-3 text-lg font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Découvrir les exposants
                    </a>
                    
                    <a href="{{ route('home') }}" 
                       class="btn btn-secondary px-8 py-3 text-lg font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Retour à l'accueil
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection 