@extends('layouts.app')

@section('title', 'Demande en cours - Eat&Drink')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-clock fa-5x text-warning"></i>
                    </div>
                    
                    <h2 class="mb-4">Demande en cours de validation</h2>
                    
                    <p class="lead mb-4">
                        Bonjour <strong>{{ auth()->user()->nom }}</strong>,
                    </p>
                    
                    <p class="mb-4">
                        Votre demande de participation à l'événement Eat&Drink a bien été reçue et est actuellement 
                        en cours d'examen par notre équipe.
                    </p>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Informations de votre demande :</strong><br>
                        <strong>Entreprise :</strong> {{ auth()->user()->nom_entreprise }}<br>
                        <strong>Stand :</strong> {{ auth()->user()->stand->nom_stand ?? 'Non défini' }}<br>
                        <strong>Date de soumission :</strong> {{ auth()->user()->created_at->format('d/m/Y à H:i') }}
                    </div>
                    
                    <p class="mb-4">
                        Vous recevrez une notification par email dès que votre demande sera traitée. 
                        En cas d'approbation, vous pourrez accéder à votre espace exposant.
                    </p>
                    
                    <div class="d-flex justify-content-center gap-3">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="fas fa-sign-out-alt me-2"></i>Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
