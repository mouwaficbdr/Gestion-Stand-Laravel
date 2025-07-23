@extends('layouts.app')

@section('title', 'Dashboard Admin - Eat&Drink')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-accent-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="mb-8">
            <h1 class="text-3xl font-display font-bold text-secondary-900 mb-2">Dashboard Administrateur</h1>
            <p class="text-secondary-600">Gestion de l'événement Eat&Drink</p>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="card bg-gradient-to-r from-warning-500 to-warning-600 text-white shadow-strong">
                <div class="card-body p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-3xl font-bold mb-1">{{ $demandesEnAttente->count() }}</div>
                            <p class="text-warning-100">Demandes en attente</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card bg-gradient-to-r from-success-500 to-success-600 text-white shadow-strong">
                <div class="card-body p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-3xl font-bold mb-1">{{ $entrepreneursApprouves->count() }}</div>
                            <p class="text-success-100">Exposants approuvés</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card bg-gradient-to-r from-info-500 to-info-600 text-white shadow-strong">
                <div class="card-body p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-3xl font-bold mb-1">{{ $demandesEnAttente->count() + $entrepreneursApprouves->count() }}</div>
                            <p class="text-info-100">Total des stands</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="card shadow-soft mb-8">
            <div class="card-header p-6 border-b border-secondary-100">
                <h2 class="text-xl font-semibold text-secondary-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Actions rapides
                </h2>
            </div>
            <div class="card-body p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <a href="{{ route('admin.demandes') }}" class="btn btn-warning w-full">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Gérer les demandes
                    </a>
                    
                    <a href="{{ route('admin.stands') }}" class="btn btn-info w-full">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Voir tous les stands
                    </a>
                    
                    <button class="btn btn-outline-secondary w-full opacity-50 cursor-not-allowed" disabled>
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Statistiques
                    </button>
                    
                    <button class="btn btn-outline-primary w-full opacity-50 cursor-not-allowed" disabled>
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Paramètres
                    </button>
                </div>
            </div>
        </div>

        <!-- Demandes récentes -->
        @if($demandesEnAttente->count() > 0)
        <div class="card shadow-strong">
            <div class="card-header p-6 border-b border-secondary-100">
                <h2 class="text-xl font-semibold text-secondary-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-warning-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Demandes en attente ({{ $demandesEnAttente->count() }})
                </h2>
            </div>
            <div class="card-body p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-secondary-200">
                        <thead class="bg-secondary-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 uppercase tracking-wider">Entreprise</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 uppercase tracking-wider">Stand</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-secondary-200">
                            @foreach($demandesEnAttente->take(5) as $demande)
                            <tr class="hover:bg-secondary-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-secondary-900">
                                    {{ $demande->nom }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-secondary-700">
                                    {{ $demande->nom_entreprise }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-secondary-700">
                                    {{ $demande->stand->nom_stand ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary-500">
                                    {{ $demande->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col space-y-2">
                                        <div class="flex space-x-2">
                                            <form action="{{ route('admin.approuver', $demande->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="btn btn-success btn-sm"
                                                        onclick="return confirm('Approuver cette demande ?')">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                        
                                        <form action="{{ route('admin.rejeter', $demande->id) }}" method="POST" class="space-y-1">
                                            @csrf
                                            @method('DELETE')
                                            <input type="text" 
                                                   name="motif_rejet" 
                                                   class="form-input text-xs py-1 px-2" 
                                                   placeholder="Motif du rejet (obligatoire)" 
                                                   required>
                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm w-full"
                                                    onclick="return confirm('Rejeter cette demande ? Cette action est irréversible.')">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Rejeter
                                            </button>
                                        </form>
                                        
                                        @if($demande->motif_rejet)
                                            <div class="text-danger-600 text-xs mt-1">
                                                Motif rejet : {{ $demande->motif_rejet }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($demandesEnAttente->count() > 5)
                <div class="mt-6 text-center">
                    <a href="{{ route('admin.demandes') }}" class="btn btn-outline-primary">
                        Voir toutes les demandes
                    </a>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
