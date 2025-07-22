@extends('layouts.app')

@section('title', 'Gestion des Stands - Admin')

@section('content')
<div class="container py-4">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">Gestion des Stands</h1>
                    <p class="text-muted">{{ $stands->total() }} stand(s) au total</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Retour au dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.stands') }}">
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <label for="statut" class="form-label">Filtrer par statut</label>
                                <select name="statut" id="statut" class="form-select">
                                    <option value="">Tous les statuts</option>
                                    <option value="approuve" {{ request('statut') === 'approuve' ? 'selected' : '' }}>
                                        Approuvés
                                    </option>
                                    <option value="en_attente" {{ request('statut') === 'en_attente' ? 'selected' : '' }}>
                                        En attente
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter me-2"></i>Filtrer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des stands -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-store me-2"></i>Liste des stands</h5>
                </div>
                <div class="card-body">
                    @if($stands->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Stand</th>
                                        <th>Propriétaire</th>
                                        <th>Entreprise</th>
                                        <th>Description</th>
                                        <th>Statut</th>
                                        <th>Date de création</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stands as $stand)
                                    <tr>
                                        <td>
                                            <strong>{{ $stand->nom_stand }}</strong>
                                        </td>
                                        <td>{{ $stand->utilisateur->nom }}</td>
                                        <td>{{ $stand->utilisateur->nom_entreprise }}</td>
                                        <td>
                                            <small>{{ Str::limit($stand->description, 60) }}</small>
                                        </td>
                                        <td>
                                            @if($stand->utilisateur->role === 'entrepreneur_approuve')
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle me-1"></i>Approuvé
                                                </span>
                                            @else
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-clock me-1"></i>En attente
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>{{ $stand->created_at->format('d/m/Y') }}</small>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $stands->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-store-slash fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucun stand trouvé</h5>
                            <p class="text-muted">Aucun stand ne correspond aux critères de recherche.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
