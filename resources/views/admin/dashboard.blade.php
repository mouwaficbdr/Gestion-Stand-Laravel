@extends('layouts.app')

@section('title', 'Administration - Eat&Drink')
@section('description', 'Dashboard administrateur pour la gestion de la plateforme Eat&Drink')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-secondary-50 to-primary-50">
    <!-- Header -->
    <div class="bg-white shadow-soft border-b border-secondary-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-display font-bold text-secondary-900 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-primary-500 to-accent-500 rounded-xl flex items-center justify-center mr-3 shadow-glow">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        Administration
                    </h1>
                    <p class="text-secondary-600 mt-1">Gestion complète de la plateforme Eat&Drink</p>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-secondary-500">Dernière connexion</p>
                        <p class="text-sm font-medium text-secondary-900">{{ now()->format('d/m/Y à H:i') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-r from-primary-500 to-accent-500 rounded-full flex items-center justify-center shadow-soft">
                        <span class="text-white font-semibold">{{ substr(auth()->user()->nom, 0, 1) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Demandes en attente -->
            <div class="card card-hover group">
                <div class="card-body p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-secondary-600 mb-1">Demandes en attente</p>
                            <p class="text-3xl font-bold text-accent-600" x-data="{ count: 0 }" x-init="
                                let target = {{ $demandesEnAttente->count() }};
                                let increment = target / 50;
                                let timer = setInterval(() => {
                                    count += increment;
                                    if (count >= target) {
                                        count = target;
                                        clearInterval(timer);
                                    }
                                }, 20);
                            " x-text="Math.floor(count)"></p>
                            @if($demandesEnAttente->count() > 0)
                                <p class="text-xs text-accent-600 font-medium">{{ $demandesEnAttente->where('created_at', '>=', now()->subDay())->count() }} nouvelles aujourd'hui</p>
                            @endif
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-accent-500 to-accent-600 rounded-xl flex items-center justify-center shadow-soft group-hover:shadow-glow transition-all duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exposants approuvés -->
            <div class="card card-hover group">
                <div class="card-body p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-secondary-600 mb-1">Exposants approuvés</p>
                            <p class="text-3xl font-bold text-success-600" x-data="{ count: 0 }" x-init="
                                let target = {{ $entrepreneursApprouves->count() }};
                                let increment = target / 50;
                                let timer = setInterval(() => {
                                    count += increment;
                                    if (count >= target) {
                                        count = target;
                                        clearInterval(timer);
                                    }
                                }, 20);
                            " x-text="Math.floor(count)"></p>
                            <p class="text-xs text-success-600 font-medium">{{ $entrepreneursApprouves->where('updated_at', '>=', now()->subWeek())->count() }} cette semaine</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-success-500 to-success-600 rounded-xl flex items-center justify-center shadow-soft group-hover:shadow-glow transition-all duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total stands -->
            <div class="card card-hover group">
                <div class="card-body p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-secondary-600 mb-1">Total des stands</p>
                            <p class="text-3xl font-bold text-primary-600" x-data="{ count: 0 }" x-init="
                                let target = {{ $demandesEnAttente->count() + $entrepreneursApprouves->count() }};
                                let increment = target / 50;
                                let timer = setInterval(() => {
                                    count += increment;
                                    if (count >= target) {
                                        count = target;
                                        clearInterval(timer);
                                    }
                                }, 20);
                            " x-text="Math.floor(count)"></p>
                            <p class="text-xs text-primary-600 font-medium">Objectif: 100 stands</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl flex items-center justify-center shadow-soft group-hover:shadow-glow transition-all duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Taux d'approbation -->
            <div class="card card-hover group">
                <div class="card-body p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-secondary-600 mb-1">Taux d'approbation</p>
                            @php
                                $total = $demandesEnAttente->count() + $entrepreneursApprouves->count();
                                $taux = $total > 0 ? round(($entrepreneursApprouves->count() / $total) * 100) : 0;
                            @endphp
                            <p class="text-3xl font-bold text-secondary-900" x-data="{ count: 0 }" x-init="
                                let target = {{ $taux }};
                                let increment = target / 50;
                                let timer = setInterval(() => {
                                    count += increment;
                                    if (count >= target) {
                                        count = target;
                                        clearInterval(timer);
                                    }
                                }, 20);
                            " x-text="Math.floor(count) + '%'"></p>
                            <p class="text-xs text-secondary-600 font-medium">des candidatures</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-secondary-500 to-secondary-600 rounded-xl flex items-center justify-center shadow-soft group-hover:shadow-glow transition-all duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="card mb-8">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-secondary-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Actions rapides
                </h3>
            </div>
            <div class="card-body p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('admin.demandes') }}" 
                       class="group flex items-center p-4 bg-gradient-to-r from-accent-50 to-accent-100 rounded-xl hover:from-accent-100 hover:to-accent-200 transition-all duration-300 hover:shadow-soft">
                        <div class="w-10 h-10 bg-gradient-to-r from-accent-500 to-accent-600 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-secondary-900">Gérer les demandes</p>
                            <p class="text-sm text-secondary-600">{{ $demandesEnAttente->count() }} en attente</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.stands') }}" 
                       class="group flex items-center p-4 bg-gradient-to-r from-primary-50 to-primary-100 rounded-xl hover:from-primary-100 hover:to-primary-200 transition-all duration-300 hover:shadow-soft">
                        <div class="w-10 h-10 bg-gradient-to-r from-primary-500 to-primary-600 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-secondary-900">Tous les stands</p>
                            <p class="text-sm text-secondary-600">{{ $entrepreneursApprouves->count() }} actifs</p>
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

        <!-- Demandes récentes -->
        @if($demandesEnAttente->count() > 0)
        <div class="card">
            <div class="card-header">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-secondary-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Demandes en attente
                        <span class="ml-2 badge badge-warning">{{ $demandesEnAttente->count() }}</span>
                    </h3>
                    @if($demandesEnAttente->count() > 5)
                        <a href="{{ route('admin.demandes') }}" class="btn btn-secondary btn-sm">
                            Voir toutes les demandes
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-body p-0">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="px-6 py-3">Candidat</th>
                                <th class="px-6 py-3">Entreprise</th>
                                <th class="px-6 py-3">Stand</th>
                                <th class="px-6 py-3">Date</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-secondary-200">
                            @foreach($demandesEnAttente->take(5) as $demande)
                            <tr class="hover:bg-secondary-50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-r from-primary-500 to-accent-500 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-white font-semibold text-sm">{{ substr($demande->nom, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-secondary-900">{{ $demande->nom }}</p>
                                            <p class="text-sm text-secondary-600">{{ $demande->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-medium text-secondary-900">{{ $demande->nom_entreprise }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-medium text-secondary-900">{{ $demande->stand->nom_stand ?? 'N/A' }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-secondary-600">{{ $demande->created_at->format('d/m/Y') }}</p>
                                    <p class="text-xs text-secondary-500">{{ $demande->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <form action="{{ route('admin.approuver', $demande->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    onclick="return confirm('Approuver cette demande ?')"
                                                    class="btn btn-success btn-sm">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Approuver
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.rejeter', $demande->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Rejeter cette demande ? Cette action est irréversible.')"
                                                    class="btn btn-danger btn-sm">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Rejeter
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-body p-12 text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-success-500 to-success-600 rounded-2xl flex items-center justify-center shadow-soft">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-secondary-900 mb-2">Aucune demande en attente</h3>
                <p class="text-secondary-600 mb-6">Toutes les demandes ont été traitées. Excellent travail !</p>
                <a href="{{ route('admin.stands') }}" class="btn btn-primary">
                    Voir tous les stands approuvés
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
