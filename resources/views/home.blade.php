@extends('layouts.app')

@section('title', 'Accueil - Eat&Drink')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Bienvenue à Eat&Drink</h1>
                <p class="lead mb-4">
                    Découvrez l'événement culinaire incontournable de l'année ! 
                    Rejoignez-nous pour une expérience gastronomique unique avec les meilleurs chefs et producteurs locaux.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-store me-2"></i>Devenir Exposant
                    </a>
                    <a href="#info" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-info-circle me-2"></i>En savoir plus
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fas fa-utensils" style="font-size: 200px; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</section>

<!-- Section Informations -->
<section id="info" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="display-5 fw-bold mb-4">Un Événement Exceptionnel</h2>
                <p class="lead text-muted">
                    Eat&Drink rassemble les passionnés de gastronomie, les chefs renommés et les producteurs locaux 
                    pour une célébration unique du goût et de la créativité culinaire.
                </p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-chef-hat fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Chefs Renommés</h5>
                        <p class="card-text">
                            Rencontrez les meilleurs chefs de la région et découvrez leurs créations exclusives.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-seedling fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Produits Locaux</h5>
                        <p class="card-text">
                            Savourez des produits frais et authentiques directement des producteurs locaux.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-wine-glass fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Dégustation</h5>
                        <p class="card-text">
                            Participez à des dégustations exclusives et découvrez de nouvelles saveurs.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Call to Action -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h3 class="fw-bold mb-4">Vous êtes un professionnel de la restauration ?</h3>
                <p class="lead mb-4">
                    Rejoignez notre événement en tant qu'exposant et présentez vos créations à un public passionné.
                </p>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus-circle me-2"></i>Demander un Stand
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
