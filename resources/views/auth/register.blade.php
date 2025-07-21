@extends('layouts.app')

@section('title', 'Inscription Exposant - Eat&Drink')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="fas fa-store me-2"></i>Demande de Stand - Exposant</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        Remplissez ce formulaire pour soumettre votre demande de participation à l'événement Eat&Drink. 
                        Votre demande sera examinée par notre équipe.
                    </p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom complet *</label>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                           id="nom" name="nom" value="{{ old('nom') }}" required>
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom_entreprise" class="form-label">Nom de l'entreprise *</label>
                                    <input type="text" class="form-control @error('nom_entreprise') is-invalid @enderror" 
                                           id="nom_entreprise" name="nom_entreprise" value="{{ old('nom_entreprise') }}" required>
                                    @error('nom_entreprise')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe *</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmer le mot de passe *</label>
                                    <input type="password" class="form-control" 
                                           id="password_confirmation" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <h5 class="mb-3"><i class="fas fa-store-alt me-2"></i>Informations du Stand</h5>

                        <div class="mb-3">
                            <label for="nom_stand" class="form-label">Nom du stand *</label>
                            <input type="text" class="form-control @error('nom_stand') is-invalid @enderror" 
                                   id="nom_stand" name="nom_stand" value="{{ old('nom_stand') }}" required>
                            @error('nom_stand')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description de votre activité *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            <div class="form-text">Décrivez votre spécialité, vos produits, votre concept...</div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Soumettre ma demande
                            </button>
                        </div>
                    </form>

                    <hr>
                    <div class="text-center">
                        <p class="mb-0">Vous avez déjà un compte ?</p>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">
                            <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
