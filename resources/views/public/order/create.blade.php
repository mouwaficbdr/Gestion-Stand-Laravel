@extends('layouts.app')

@section('title', 'Valider ma commande')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-accent-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-display font-bold text-secondary-900 mb-4">Valider ma commande</h1>
            
            <!-- Stand Info -->
            <div class="card shadow-soft mb-6">
                <div class="card-body p-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-primary-500 to-accent-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-secondary-900">{{ $stand->nom_stand }}</h3>
                            <p class="text-secondary-600">{{ $stand->utilisateur->nom_entreprise }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Order Summary -->
        <div class="card shadow-soft mb-8">
            <div class="card-header p-6 border-b border-secondary-100">
                <h2 class="text-xl font-semibold text-secondary-900">Récapitulatif de commande</h2>
            </div>
            <div class="card-body p-0">
                <div class="divide-y divide-secondary-100">
                    @foreach($cart as $item)
                        <div class="flex justify-between items-center p-6">
                            <div>
                                <span class="font-medium text-secondary-900">{{ $item['nom'] }}</span>
                                <span class="text-secondary-600 ml-2">x {{ $item['quantite'] }}</span>
                            </div>
                            <span class="font-semibold text-secondary-900">
                                {{ number_format($item['prix'] * $item['quantite'], 2, ',', ' ') }} €
                            </span>
                        </div>
                    @endforeach
                    
                    <!-- Total -->
                    <div class="flex justify-between items-center p-6 bg-secondary-50">
                        <span class="text-lg font-bold text-secondary-900">Total</span>
                        <span class="text-lg font-bold text-primary-600">
                            {{ number_format($total, 2, ',', ' ') }} €
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Order Form -->
        <div class="card shadow-strong">
            <div class="card-header p-6 border-b border-secondary-100">
                <h2 class="text-xl font-semibold text-secondary-900">Informations de livraison</h2>
            </div>
            <div class="card-body p-6">
                <form action="{{ route('order.store', $stand->id) }}" 
                      method="POST" 
                      class="space-y-6"
                      @submit="loading = true"
                      x-data="{ loading: false }">
                    @csrf
                    
                    <!-- Honeypot -->
                    <div style="display:none">
                        <input type="text" name="honeypot" value="">
                    </div>
                    
                    <div>
                        <label for="nom" class="form-label">Nom complet</label>
                        <input type="text" 
                               name="nom" 
                               id="nom" 
                               class="form-input @error('nom') border-danger-300 focus:ring-danger-500 focus:border-danger-500 @enderror" 
                               value="{{ old('nom') }}" 
                               required>
                        @error('nom')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="form-input @error('email') border-danger-300 focus:ring-danger-500 focus:border-danger-500 @enderror" 
                               value="{{ old('email') }}" 
                               required>
                        @error('email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="telephone" class="form-label">Numéro de téléphone</label>
                        <input type="tel" 
                               name="telephone" 
                               id="telephone" 
                               class="form-input @error('telephone') border-danger-300 focus:ring-danger-500 focus:border-danger-500 @enderror" 
                               value="{{ old('telephone') }}" 
                               required>
                        @error('telephone')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="pt-6">
                        <button type="submit" 
                                :disabled="loading"
                                class="btn btn-success w-full py-4 text-lg font-semibold">
                            <span x-show="!loading" class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Valider la commande
                            </span>
                            <span x-show="loading" class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Envoi en cours...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 