@extends('layouts.app')

@section('title', 'Dashboard Exposant - Eat&Drink')

@section('content')
<div class="container py-4">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">Dashboard Exposant</h1>
                    <p class="text-muted">Bienvenue {{ $user->nom }} - {{ $user->nom_entreprise }}</p>
                </div>
                <div>
                    <span class="badge badge-success fs-6">
                        <i class="fas fa-check-circle me-1"></i>Approuvé
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Informations du stand -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-store me-2"></i>Informations de votre stand</h5>
                </div>
                <div class="card-body">
                    @if($stand)
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Nom du stand</h6>
                                <p class="mb-3">{{ $stand->nom_stand }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Date de création</h6>
                                <p class="mb-3">{{ $stand->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        
                        <h6 class="fw-bold">Description</h6>
                        <p class="mb-0">{{ $stand->description }}</p>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Aucun stand associé à votre compte.
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Statistiques</h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div class="mb-3">
                            <i class="fas fa-eye fa-2x text-primary"></i>
                            <h4 class="mt-2">0</h4>
                            <small class="text-muted">Vues du stand</small>
                        </div>
                        
                        <div class="mb-3">
                            <i class="fas fa-shopping-cart fa-2x text-success"></i>
                            <h4 class="mt-2">0</h4>
                            <small class="text-muted">Produits</small>
                        </div>
                        
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Fonctionnalités à venir
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Actions rapides</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="d-grid">
                                <button class="btn btn-outline-primary" disabled>
                                    <i class="fas fa-plus me-2"></i>Ajouter un produit
                                </button>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="d-grid">
                                <button class="btn btn-outline-secondary" disabled>
                                    <i class="fas fa-edit me-2"></i>Modifier le stand
                                </button>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="d-grid">
                                <button class="btn btn-outline-info" disabled>
                                    <i class="fas fa-chart-line me-2"></i>Voir les stats
                                </button>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="d-grid">
                                <button class="btn btn-outline-warning" disabled>
                                    <i class="fas fa-cog me-2"></i>Paramètres
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mt-3 mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Pas encore fait :</strong> Gestion des produits, statistiques détaillées !
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
