@extends('layouts.app')

@section('title', 'Gestion des Stands - Admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-accent-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-display font-bold text-secondary-900 mb-2">Gestion des Stands</h1>
                    <p class="text-secondary-600">{{ $stands->total() }} stand(s) au total</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour au dashboard
                </a>
            </div>
        </div>

        <!-- Filtres -->
        <div class="card shadow-soft mb-8">
            <div class="card-body p-6">
                <form method="GET" action="{{ route('admin.stands') }}">
                    <div class="flex flex-col sm:flex-row gap-4 items-end">
                        <div class="flex-1">
                            <label for="statut" class="form-label">Filtrer par statut</label>
                            <select name="statut" id="statut" class="form-input">
                                <option value="">Tous les statuts</option>
                                <option value="approuve" {{ request('statut') === 'approuve' ? 'selected' : '' }}>
                                    Approuvés
                                </option>
                                <option value="en_attente" {{ request('statut') === 'en_attente' ? 'selected' : '' }}>
                                    En attente
                                </option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                Filtrer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Liste des stands -->
        <div class="card shadow-strong">
            <div class="card-header p-6 border-b border-secondary-100">
                <h2 class="text-xl font-semibold text-secondary-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Liste des stands
                </h2>
            </div>
            <div class="card-body p-6">
                @if($stands->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-secondary-200">
                            <thead class="bg-secondary-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 uppercase tracking-wider">Stand</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 uppercase tracking-wider">Propriétaire</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 uppercase tracking-wider">Entreprise</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-secondary-200">
                                @foreach($stands as $stand)
                                <tr class="hover:bg-secondary-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-semibold text-secondary-900">{{ $stand->nom_stand }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-secondary-700">
                                        {{ $stand->utilisateur->nom }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-secondary-700">
                                        {{ $stand->utilisateur->nom_entreprise }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-secondary-600 max-w-xs truncate">
                                            {{ Str::limit($stand->description, 60) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col space-y-1">
                                            @if($stand->utilisateur->role === 'entrepreneur_approuve')
                                                <span class="badge badge-success">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Approuvé
                                                </span>
                                            @else
                                                <span class="badge badge-warning">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    En attente
                                                </span>
                                            @endif
                                            
                                            @if($stand->utilisateur->motif_retrait)
                                                <div class="text-xs text-warning-600 mt-1">
                                                    <strong>Motif retrait :</strong> {{ $stand->utilisateur->motif_retrait }}
                                                </div>
                                            @endif
                                            
                                            @if($stand->utilisateur->motif_rejet)
                                                <div class="text-xs text-danger-600 mt-1">
                                                    <strong>Motif rejet :</strong> {{ $stand->utilisateur->motif_rejet }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary-500">
                                        {{ $stand->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            @if($stand->utilisateur->role === 'entrepreneur_en_attente')
                                                <!-- Approuver -->
                                                <form action="{{ route('admin.approuver', $stand->utilisateur->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="btn btn-success btn-sm"
                                                            onclick="return confirm('Approuver ce stand ?')"
                                                            title="Approuver le stand">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                                
                                                <!-- Rejeter -->
                                                <form action="{{ route('admin.rejeter', $stand->utilisateur->id) }}" method="POST" class="inline" x-data="{ showRejectForm: false }">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div x-show="!showRejectForm">
                                                        <button type="button" 
                                                                @click="showRejectForm = true"
                                                                class="btn btn-danger btn-sm"
                                                                title="Rejeter le stand">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div x-show="showRejectForm" class="flex flex-col space-y-1" style="display: none;">
                                                        <input type="text" 
                                                               name="motif_rejet" 
                                                               placeholder="Motif du rejet" 
                                                               class="form-input text-xs py-1 px-2 w-32" 
                                                               required>
                                                        <div class="flex space-x-1">
                                                            <button type="submit" 
                                                                    class="btn btn-danger btn-sm text-xs px-2 py-1"
                                                                    onclick="return confirm('Rejeter définitivement ce stand ?')">
                                                                Rejeter
                                                            </button>
                                                            <button type="button" 
                                                                    @click="showRejectForm = false"
                                                                    class="btn btn-secondary btn-sm text-xs px-2 py-1">
                                                                Annuler
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            @else
                                                <!-- Retirer l'approbation -->
                                                <form action="{{ route('admin.retirer', $stand->utilisateur->id) }}" method="POST" class="inline" x-data="{ showRetireForm: false }">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div x-show="!showRetireForm">
                                                        <button type="button" 
                                                                @click="showRetireForm = true"
                                                                class="btn btn-warning btn-sm"
                                                                title="Retirer l'approbation">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div x-show="showRetireForm" class="flex flex-col space-y-1" style="display: none;">
                                                        <input type="text" 
                                                               name="motif_retrait" 
                                                               placeholder="Motif du retrait" 
                                                               class="form-input text-xs py-1 px-2 w-32" 
                                                               required>
                                                        <div class="flex space-x-1">
                                                            <button type="submit" 
                                                                    class="btn btn-warning btn-sm text-xs px-2 py-1"
                                                                    onclick="return confirm('Retirer l\'approbation de ce stand ?')">
                                                                Retirer
                                                            </button>
                                                            <button type="button" 
                                                                    @click="showRetireForm = false"
                                                                    class="btn btn-secondary btn-sm text-xs px-2 py-1">
                                                                Annuler
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 flex justify-center">
                        <div class="bg-white rounded-xl shadow-soft border border-secondary-100 p-2">
                            {{ $stands->appends(request()->query())->links() }}
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-r from-secondary-100 to-secondary-200 rounded-2xl flex items-center justify-center">
                            <svg class="w-12 h-12 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-secondary-900 mb-2">Aucun stand trouvé</h3>
                        <p class="text-secondary-600">Aucun stand ne correspond aux critères de recherche.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
