@extends('layouts.app')

@section('title', 'Eat&Drink - Plateforme Culinaire Moderne')
@section('description', 'Découvrez la plateforme culinaire incontournable avec les meilleurs chefs et producteurs locaux. Une expérience gastronomique unique vous attend.')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background with parallax effect -->
    <div class="absolute inset-0 gradient-hero"></div>
    <div class="absolute inset-0 bg-black/20"></div>
    
    <!-- Animated background elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-accent-400/20 rounded-full blur-3xl animate-float" style="animation-delay: -2s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-128 h-128 bg-primary-400/10 rounded-full blur-3xl animate-float" style="animation-delay: -4s;"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="animate-slide-up">


            <!-- Main heading -->
            <h1 class="text-5xl md:text-7xl font-display font-bold text-white mb-6 leading-tight">
                Découvrez les
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-accent-300 to-accent-100">
                    Saveurs Authentiques
                </span>
                de votre région
            </h1>

            <!-- Subtitle -->
            <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-3xl mx-auto leading-relaxed">
                Rejoignez la plateforme culinaire incontournable qui rassemble les meilleurs producteurs locaux, 
                restaurants et créateurs pour une expérience gastronomique unique.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                <a href="{{ route('stands.public.index') }}" 
                   class="btn btn-primary btn-lg px-8 py-4 text-lg font-semibold shadow-glow hover:shadow-strong transform hover:scale-105 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Explorer les Exposants
                </a>
                
                @guest
                <a href="{{ route('register') }}" 
                   class="btn btn-secondary btn-lg px-8 py-4 text-lg font-semibold bg-white/20 backdrop-blur-sm border-white/30 text-white hover:bg-white/30 transform hover:scale-105 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Devenir Exposant
                </a>
                @endguest
            </div>

            <!-- Scroll indicator -->
            <div class="animate-bounce-subtle">
                <svg class="w-6 h-6 text-white/70 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-20 bg-white relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-50 to-accent-50"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-secondary-900 mb-4">
                Nos chiffres clés
            </h2>
            <p class="text-xl text-secondary-600 max-w-2xl mx-auto">
                Une communauté grandissante de passionnés de gastronomie
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center group">
                <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-r from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center shadow-soft group-hover:shadow-medium transition-all duration-300 group-hover:scale-105">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="text-4xl font-bold text-primary-600 mb-2" x-data="{ count: 0 }" x-init="
                    let target = 50;
                    let increment = target / 100;
                    let timer = setInterval(() => {
                        count += increment;
                        if (count >= target) {
                            count = target;
                            clearInterval(timer);
                        }
                    }, 20);
                " x-text="Math.floor(count) + '+'"></div>
                <div class="text-secondary-600 font-medium">Exposants confirmés</div>
            </div>

            <div class="text-center group">
                <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-r from-success-500 to-success-600 rounded-2xl flex items-center justify-center shadow-soft group-hover:shadow-medium transition-all duration-300 group-hover:scale-105">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="text-4xl font-bold text-success-600 mb-2" x-data="{ count: 0 }" x-init="
                    let target = 5000;
                    let increment = target / 100;
                    let timer = setInterval(() => {
                        count += increment;
                        if (count >= target) {
                            count = target;
                            clearInterval(timer);
                        }
                    }, 20);
                " x-text="Math.floor(count) + '+'"></div>
                <div class="text-secondary-600 font-medium">Visiteurs attendus</div>
            </div>

            <div class="text-center group">
                <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-r from-accent-500 to-accent-600 rounded-2xl flex items-center justify-center shadow-soft group-hover:shadow-medium transition-all duration-300 group-hover:scale-105">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <div class="text-4xl font-bold text-accent-600 mb-2" x-data="{ count: 0 }" x-init="
                    let target = 200;
                    let increment = target / 100;
                    let timer = setInterval(() => {
                        count += increment;
                        if (count >= target) {
                            count = target;
                            clearInterval(timer);
                        }
                    }, 20);
                " x-text="Math.floor(count) + '+'"></div>
                <div class="text-secondary-600 font-medium">Produits uniques</div>
            </div>

            <div class="text-center group">
                <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-r from-danger-500 to-danger-600 rounded-2xl flex items-center justify-center shadow-soft group-hover:shadow-medium transition-all duration-300 group-hover:scale-105">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="text-4xl font-bold text-danger-600 mb-2">3</div>
                <div class="text-secondary-600 font-medium">Jours d'ouverture</div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-gradient-to-br from-secondary-50 to-primary-50 relative overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute top-0 left-0 w-72 h-72 bg-primary-200/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-accent-200/30 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-secondary-900 mb-4">
                Une expérience culinaire unique
            </h2>
            <p class="text-xl text-secondary-600 max-w-3xl mx-auto">
                Eat&Drink rassemble les passionnés de gastronomie, les chefs renommés et les producteurs locaux 
                pour une célébration authentique du goût et de la créativité culinaire.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="group">
                <div class="card card-hover h-full text-center p-8">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-r from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center shadow-soft group-hover:shadow-glow transition-all duration-300 group-hover:scale-110">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-secondary-900 mb-4">Chefs Renommés</h3>
                    <p class="text-secondary-600 leading-relaxed">
                        Rencontrez les meilleurs chefs de la région et découvrez leurs créations exclusives. 
                        Des démonstrations culinaires et des dégustations vous attendent.
                    </p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="group">
                <div class="card card-hover h-full text-center p-8">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-r from-success-500 to-success-600 rounded-2xl flex items-center justify-center shadow-soft group-hover:shadow-glow transition-all duration-300 group-hover:scale-110">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-secondary-900 mb-4">Produits Locaux</h3>
                    <p class="text-secondary-600 leading-relaxed">
                        Savourez des produits frais et authentiques directement des producteurs locaux. 
                        Découvrez le terroir et les savoir-faire traditionnels de votre région.
                    </p>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="group">
                <div class="card card-hover h-full text-center p-8">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-r from-accent-500 to-accent-600 rounded-2xl flex items-center justify-center shadow-soft group-hover:shadow-glow transition-all duration-300 group-hover:scale-110">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-secondary-900 mb-4">Expériences Uniques</h3>
                    <p class="text-secondary-600 leading-relaxed">
                        Participez à des ateliers culinaires, des dégustations exclusives et des rencontres 
                        avec les artisans. Une immersion totale dans l'art culinaire.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-primary-600 via-primary-500 to-accent-500 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="absolute inset-0">
        <div class="absolute top-10 left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl animate-float"></div>
        <div class="absolute bottom-10 right-10 w-48 h-48 bg-white/5 rounded-full blur-3xl animate-float" style="animation-delay: -3s;"></div>
    </div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-6">
            Vous êtes un professionnel de la restauration ?
        </h2>
        <p class="text-xl text-white/90 mb-8 leading-relaxed">
            Rejoignez notre communauté d'exposants et faites découvrir vos créations à des milliers de visiteurs passionnés. 
            Une opportunité unique de développer votre activité et de créer des liens durables.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            @guest
            <a href="{{ route('register') }}" 
               class="btn btn-secondary btn-lg px-8 py-4 text-lg font-semibold bg-white text-primary-600 hover:bg-white/90 shadow-strong hover:shadow-glow transform hover:scale-105 transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Postuler comme Exposant
            </a>
            @endguest
            
            <a href="{{ route('stands.public.index') }}" 
               class="btn btn-secondary btn-lg px-8 py-4 text-lg font-semibold bg-white/20 backdrop-blur-sm border-white/30 text-white hover:bg-white/30 transform hover:scale-105 transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                En savoir plus
            </a>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="card p-8 bg-gradient-to-br from-primary-50 to-accent-50 border-gradient">
            <h3 class="text-2xl font-display font-bold text-secondary-900 mb-4">
                Restez informé de nos actualités
            </h3>
            <p class="text-secondary-600 mb-6">
                Recevez en avant-première les informations sur nos événements, nouveaux exposants et offres exclusives.
            </p>
            
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto" x-data="{ email: '', loading: false }">
                <input type="email" 
                       x-model="email"
                       placeholder="Votre adresse email" 
                       class="form-input flex-1 text-center sm:text-left"
                       required>
                <button type="submit" 
                        :disabled="loading"
                        class="btn btn-primary px-6 py-3 font-semibold"
                        @click.prevent="
                            loading = true;
                            setTimeout(() => {
                                loading = false;
                                email = '';
                                alert('Merci pour votre inscription !');
                            }, 1000);
                        ">
                    <span x-show="!loading">S'inscrire</span>
                    <span x-show="loading" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Inscription...
                    </span>
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
