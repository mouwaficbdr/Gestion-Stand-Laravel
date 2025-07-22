@extends('layouts.app')

@section('title', 'Dashboard Admin - Eat&Drink')

@section('content')
<div class="container py-4">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-1">Dashboard Administrateur</h1>
            <p class="text-muted">Gestion de l'événement Eat&Drink</p>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ $demandesEnAttente->count() }}</h4>
                            <p class="mb-0">Demandes en attente</p>
                        </div>
                        <div>
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ $entrepreneursApprouves->count() }}</h4>
                            <p class="mb-0">Exposants approuvés</p>
                        </div>
                        <div>
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ $demandesEnAttente->count() + $entrepreneursApprouves->count() }}</h4>
                            <p class="mb-0">Total des stands</p>
                        </div>
                        <div>
                            <i class="fas fa-store fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Actions rapides</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="d-grid">
                                <a href="{{ route('admin.demandes') }}" class="btn btn-warning">
                                    <i class="fas fa-clock me-2"></i>Gérer les demandes
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="d-grid">
                                <a href="{{ route('admin.stands') }}" class="btn btn-info">
                                    <i class="fas fa-store me-2"></i>Voir tous les stands
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="d-grid">
                                <button class="btn btn-outline-secondary" disabled>
                                    <i class="fas fa-chart-bar me-2"></i>Statistiques
                                </button>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="d-grid">
                                <button class="btn btn-outline-primary" disabled>
                                    <i class="fas fa-cog me-2"></i>Paramètres
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Demandes récentes -->
    @if($demandesEnAttente->count() > 0)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Demandes en attente ({{ $demandesEnAttente->count() }})</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Entreprise</th>
                                    <th>Stand</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($demandesEnAttente->take(5) as $demande)
                                <tr>
                                    <td>{{ $demande->nom }}</td>
                                    <td>{{ $demande->nom_entreprise }}</td>
                                    <td>{{ $demande->stand->nom_stand ?? 'N/A' }}</td>
                                    <td>{{ $demande->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.approuver', $demande->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" 
                                                    onclick="return confirm('Approuver cette demande ?')">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.rejeter', $demande->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Rejeter cette demande ? Cette action est irréversible.')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if($demandesEnAttente->count() > 5)
                    <div class="text-center">
                        <a href="{{ route('admin.demandes') }}" class="btn btn-outline-primary">
                            Voir toutes les demandes
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
