@extends('layouts.app')

@section('title', 'Mon Espace Exposant - Eat&Drink')
@section('description', 'Dashboard exposant pour la gestion de votre stand et vos produits')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-accent-50">
    <!-- Header -->
    <div class="bg-white shadow-soft border-b border-secondary-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center mb-2">
                        <h1 class="text-3xl font-display font-bold text-secondary-900 flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-primary-500 to-accent-500 rounded-xl flex items-center justify-center mr-3 shadow-glow">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            Mon Espace Exposant
                        </h1>
                        <span class="ml-3 badge badge-success">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Approuvé
                        </span>
                    </div>
                    <p class="text-secondary-600">Bienvenue <span class="font-semibold">{{ $user->nom }}</span> - {{ $user->nom_entreprise }}</p>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-secondary-500">Membre depuis</p>
                        <p class="text-sm font-medium text-secondary-900">{{ $user->created_at->format('M Y') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-r from-primary-500 to-accent-500 rounded-full flex items-center justify-center shadow-soft">
                        <span class="text-white font-semibold">{{ substr($user->nom, 0, 1) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Produits -->
            <div class="card card-hover group">
                <div class="card-body p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-secondary-600 mb-1">Mes produits</p>
                            <p class="text-3xl font-bold text-primary-600" x-data="{ count: 0 }" x-init="
                                let target = {{ $user->products->count() ?? 0 }};
                                let increment = target / 30;
                                let timer = setInterval(() => {
                                    count += increment;
                                    if (count >= target) {
                                        count = target;
                                        clearInterval(timer);
                                    }
                                }, 30);
                            " x-text="Math.floor(count)"></p>
                            <p class="text-xs text-primary-600 font-medium">produits en ligne</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl flex items-center justify-center shadow-soft group-hover:shadow-glow transition-all duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vues du stand -->
            <div class="card card-hover group">
                <div class="card-body p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-secondary-600 mb-1">Vues du stand</p>
                            <p class="text-3xl font-bold text-success-600" x-data="{ count: 0 }" x-init="
                                let target = 0; // À remplacer par les vraies données
                                let increment = target / 30;
                                let timer = setInterval(() => {
                                    count += increment;
                                    if (count >= target) {
                                        count = target;
                                        clearInterval(timer);
                                    }
                                }, 30);
                            " x-text="Math.floor(count)"></p>
                            <p class="text-xs text-success-600 font-medium">cette semaine</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-success-500 to-success-600 rounded-xl flex items-center justify-center shadow-soft group-hover:shadow-glow transition-all duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Commandes -->
            <div class="card card-hover group">
                <div class="card-body p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-secondary-600 mb-1">Commandes</p>
                            <p class="text-3xl font-bold text-accent-600" x-data="{ count: 0 }" x-init="
                                let target = 0; // À remplacer par les vraies données
                                let increment = target / 30;
                                let timer = setInterval(() => {
                                    count += increment;
                                    if (count >= target) {
                                        count = target;
                                        clearInterval(timer);
                                    }
                                }, 30);
                            " x-text="Math.floor(count)"></p>
                            <p class="text-xs text-accent-600 font-medium">ce mois-ci</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-accent-500 to-accent-600 rounded-xl flex items-center justify-center shadow-soft group-hover:shadow-glow transition-all duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chiffre d'affaires -->
            <div class="card card-hover group">
                <div class="card-body p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-secondary-600 mb-1">Chiffre d'affaires</p>
                            <p class="text-3xl font-bold text-secondary-900">0€</p>
                            <p class="text-xs text-secondary-600 font-medium">ce mois-ci</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-secondary-500 to-secondary-600 rounded-xl flex items-center justify-center shadow-soft group-hover:shadow-glow transition-all duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Stand Information -->
            <div class="lg:col-span-2">
                <div class="card mb-6">
                    <div class="card-header">
                        <h3 class="text-lg font-semibold text-secondary-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Informations de votre stand
                        </h3>
                    </div>
                    <div class="card-body p-6">
                        @if($stand)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="text-sm font-medium text-secondary-600">Nom du stand</label>
                                    <p class="text-lg font-semibold text-secondary-900 mt-1">{{ $stand->nom_stand }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-secondary-600">Date de création</label>
                                    <p class="text-lg font-semibold text-secondary-900 mt-1">{{ $stand->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <label class="text-sm font-medium text-secondary-600">Description</label>
                                <p class="text-secondary-900 mt-2 leading-relaxed">{{ $stand->description }}</p>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-secondary-100">
                                <div class="flex items-center space-x-4">
                                    <span class="badge badge-success">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Stand actif
                                    </span>
                                    <span class="text-sm text-secondary-500">Visible par les visiteurs</span>
                                </div>
                                <button class="btn btn-secondary btn-sm" disabled>
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Modifier
                                </button>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-accent-500 to-accent-600 rounded-2xl flex items-center justify-center shadow-soft">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-secondary-900 mb-2">Aucun stand associé</h3>
                                <p class="text-secondary-600">Contactez l'administration pour résoudre ce problème.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-semibold text-secondary-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Actions rapides
                        </h3>
                    </div>
                    <div class="card-body p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('entrepreneur.products.index') }}" 
                               class="group flex items-center p-4 bg-gradient-to-r from-primary-50 to-primary-100 rounded-xl hover:from-primary-100 hover:to-primary-200 transition-all duration-300 hover:shadow-soft">
                                <div class="w-10 h-10 bg-gradient-to-r from-primary-500 to-primary-600 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-secondary-900">Gérer mes produits</p>
                                    <p class="text-sm text-secondary-600">{{ $user->products->count() ?? 0 }} produits</p>
                                </div>
                            </a>

                            <button class="group flex items-center p-4 bg-gradient-to-r from-success-50 to-success-100 rounded-xl hover:from-success-100 hover:to-success-200 transition-all duration-300 hover:shadow-soft opacity-75 cursor-not-allowed">
                                <div class="w-10 h-10 bg-gradient-to-r from-success-500 to-success-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-secondary-900">Statistiques</p>
                                    <p class="text-sm text-secondary-600">Bientôt disponible</p>
                                </div>
                            </button>

                            <button class="group flex items-center p-4 bg-gradient-to-r from-accent-50 to-accent-100 rounded-xl hover:from-accent-100 hover:to-accent-200 transition-all duration-300 hover:shadow-soft opacity-75 cursor-not-allowed">
                                <div class="w-10 h-10 bg-gradient-to-r from-accent-500 to-accent-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-secondary-900">Commandes</p>
                                    <p class="text-sm text-secondary-600">Gestion des ventes</p>
                                </div>
                            </button>

                            <button class="group flex items-center p-4 bg-gradient-to-r from-secondary-50 to-secondary-100 rounded-xl hover:from-secondary-100 hover:to-secondary-200 transition-all duration-300 hover:shadow-soft opacity-75 cursor-not-allowed">
                                <div class="w-10 h-10 bg-gradient-to-r from-secondary-500 to-secondary-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-secondary-900">Paramètres</p>
                                    <p class="text-sm text-secondary-600">Configuration</p>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </div>
</div>
@endsection
