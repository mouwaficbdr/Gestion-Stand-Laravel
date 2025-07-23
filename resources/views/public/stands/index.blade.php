@extends('layouts.app')

@section('title', 'Nos Exposants - Eat&Drink')
@section('description', 'Découvrez tous nos exposants et leurs créations culinaires uniques sur la plateforme Eat&Drink.')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-accent-50" x-data="standsPage()">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-primary-600 via-primary-500 to-accent-500 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="absolute inset-0">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl animate-float"></div>
            <div class="absolute bottom-10 right-10 w-48 h-48 bg-white/5 rounded-full blur-3xl animate-float" style="animation-delay: -3s;"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-display font-bold text-white mb-6">
                    Nos Exposants
                </h1>
                <p class="text-xl text-white/90 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Découvrez les artisans passionnés qui participent à notre plateforme culinaire. 
                    Chaque exposant apporte son savoir-faire unique et ses créations authentiques.
                </p>
                
                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" 
                               x-model="searchQuery"
                               @input="filterStands()"
                               placeholder="Rechercher un exposant, une spécialité..." 
                               class="w-full pl-12 pr-16 py-4 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 transition-all duration-300">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                            <button @click="clearSearch()" 
                                    x-show="searchQuery.length > 0"
                                    class="bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg p-2 transition-all duration-300 mr-2">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & Stats -->
    <div class="bg-white shadow-soft border-b border-secondary-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <!-- Stats -->
                <div class="flex items-center space-x-6 text-sm text-secondary-600">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span class="font-medium text-secondary-900">{{ $stands->total() }}</span> exposants
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span class="font-medium text-secondary-900">{{ $stands->sum(function($stand) { return $stand->utilisateur->products->count(); }) }}</span> produits
                    </div>
                </div>

                <!-- View Toggle & Sort -->
                <div class="flex items-center space-x-4">
                    <!-- View Toggle -->
                    <div class="flex items-center bg-secondary-100 rounded-lg p-1">
                        <button @click="viewMode = 'grid'" 
                                :class="viewMode === 'grid' ? 'bg-white shadow-sm text-secondary-900' : 'text-secondary-600 hover:text-secondary-900'"
                                class="p-2 rounded-md transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                        </button>
                        <button @click="viewMode = 'list'" 
                                :class="viewMode === 'list' ? 'bg-white shadow-sm text-secondary-900' : 'text-secondary-600 hover:text-secondary-900'"
                                class="p-2 rounded-md transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Sort -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="flex items-center space-x-2 px-4 py-2 bg-white border border-secondary-300 rounded-lg hover:bg-secondary-50 transition-colors duration-200">
                            <svg class="w-4 h-4 text-secondary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                            </svg>
                            <span class="text-sm text-secondary-700" x-text="getSortLabel()"></span>
                            <svg class="w-4 h-4 text-secondary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open" 
                             x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             @click.away="open = false"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-strong border border-secondary-100 py-2 z-10"
                             style="display: none;">
                            <button @click="setSortBy('recent'); open = false" 
                                    :class="sortBy === 'recent' ? 'bg-primary-50 text-primary-600' : 'text-secondary-700 hover:bg-secondary-50'"
                                    class="block w-full text-left px-4 py-2 text-sm transition-colors duration-200">
                                Plus récents
                            </button>
                            <button @click="setSortBy('alphabetical'); open = false" 
                                    :class="sortBy === 'alphabetical' ? 'bg-primary-50 text-primary-600' : 'text-secondary-700 hover:bg-secondary-50'"
                                    class="block w-full text-left px-4 py-2 text-sm transition-colors duration-200">
                                Alphabétique
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- Ex
posants Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Results Info -->
        <div class="mb-6 text-center" x-show="searchQuery.length > 0">
            <p class="text-secondary-600">
                <span x-text="filteredStands.length"></span> résultat(s) pour "<span x-text="searchQuery" class="font-semibold"></span>"
            </p>
        </div>

        <!-- No Results -->
        <div x-show="filteredStands.length === 0 && searchQuery.length > 0" class="text-center py-16">
            <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-r from-secondary-100 to-secondary-200 rounded-2xl flex items-center justify-center">
                <svg class="w-12 h-12 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-semibold text-secondary-900 mb-4">Aucun résultat trouvé</h3>
            <p class="text-secondary-600 mb-8 max-w-md mx-auto">
                Aucun exposant ne correspond à votre recherche. Essayez avec d'autres mots-clés.
            </p>
            <button @click="clearSearch()" class="btn btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Effacer la recherche
            </button>
        </div>

        @if($stands->count() > 0)
            <!-- Grid View -->
            <div x-show="viewMode === 'grid'" 
                 :class="viewMode === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8' : 'hidden'">
                <template x-for="stand in filteredStands" :key="stand.id">
                    <div class="group">
                        <div class="card card-hover h-full overflow-hidden">
                            <!-- Image/Avatar -->
                            <div class="relative h-48 bg-gradient-to-br from-primary-400 to-accent-500 overflow-hidden">
                                <div x-show="stand.image" class="w-full h-full">
                                    <img :src="'/storage/' + stand.image" 
                                         :alt="stand.nom_stand" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <div x-show="!stand.image" class="w-full h-full flex items-center justify-center">
                                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                                        <span class="text-3xl font-bold text-white" x-text="stand.nom_stand.charAt(0)"></span>
                                    </div>
                                </div>
                                
                                <!-- Overlay with quick actions -->
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <a :href="'/exposants/' + stand.id" 
                                       class="btn btn-secondary btn-sm bg-white/20 backdrop-blur-sm border-white/30 text-white hover:bg-white/30">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Voir
                                    </a>
                                </div>

                                <!-- Badge -->
                                <div class="absolute top-4 left-4">
                                    <span class="badge badge-success bg-white/20 backdrop-blur-sm border-white/30 text-white">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Vérifié
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="card-body p-6">
                                <div class="mb-3">
                                    <h3 class="text-xl font-semibold text-secondary-900 mb-1 group-hover:text-primary-600 transition-colors duration-200" x-text="stand.nom_stand"></h3>
                                    <p class="text-sm text-secondary-600" x-text="stand.nom_entreprise"></p>
                                </div>

                                <p class="text-secondary-600 text-sm leading-relaxed mb-4" x-text="stand.description.length > 120 ? stand.description.substring(0, 120) + '...' : stand.description"></p>

                                <!-- Stats -->
                                <div class="flex items-center justify-between text-xs text-secondary-500 mb-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                            <span x-text="stand.products_count + ' produits'"></span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span x-text="'Membre depuis ' + stand.created_at"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <a :href="'/exposants/' + stand.id" 
                                   class="btn btn-primary w-full group-hover:shadow-glow transition-all duration-300">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Découvrir le stand
                                </a>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- List View -->
            <div x-show="viewMode === 'list'" 
                 :class="viewMode === 'list' ? 'space-y-6' : 'hidden'">
                <template x-for="stand in filteredStands" :key="stand.id">
                    <div class="card card-hover">
                        <div class="card-body p-6">
                            <div class="flex items-start space-x-6">
                                <!-- Image -->
                                <div class="flex-shrink-0">
                                    <div class="w-24 h-24 bg-gradient-to-br from-primary-400 to-accent-500 rounded-xl overflow-hidden">
                                        <div x-show="stand.image" class="w-full h-full">
                                            <img :src="'/storage/' + stand.image" 
                                                 :alt="stand.nom_stand" 
                                                 class="w-full h-full object-cover">
                                        </div>
                                        <div x-show="!stand.image" class="w-full h-full flex items-center justify-center">
                                            <span class="text-xl font-bold text-white" x-text="stand.nom_stand.charAt(0)"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between mb-2">
                                        <div>
                                            <h3 class="text-xl font-semibold text-secondary-900 mb-1" x-text="stand.nom_stand"></h3>
                                            <p class="text-sm text-secondary-600" x-text="stand.nom_entreprise"></p>
                                        </div>
                                        <span class="badge badge-success">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Vérifié
                                        </span>
                                    </div>

                                    <p class="text-secondary-600 text-sm leading-relaxed mb-4" x-text="stand.description"></p>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-6 text-xs text-secondary-500">
                                            <div class="flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                                <span x-text="stand.products_count + ' produits'"></span>
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span x-text="'Membre depuis ' + stand.created_at"></span>
                                            </div>
                                        </div>

                                        <a :href="'/exposants/' + stand.id" 
                                           class="btn btn-primary">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                            Découvrir le stand
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-r from-secondary-100 to-secondary-200 rounded-2xl flex items-center justify-center">
                    <svg class="w-12 h-12 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold text-secondary-900 mb-4">Aucun exposant trouvé</h3>
                <p class="text-secondary-600 mb-8 max-w-md mx-auto">
                    Il n'y a actuellement aucun exposant disponible. Revenez bientôt pour découvrir nos artisans !
                </p>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Retour à l'accueil
                </a>
            </div>
        @endif

        <!-- Pagination -->
        @if($stands->count() > 0)
            <div class="mt-12 flex justify-center">
                <div class="bg-white rounded-xl shadow-soft border border-secondary-100 p-2">
                    {{ $stands->links() }}
                </div>
            </div>
        @endif
    </div>

    <!-- Newsletter CTA -->
    <div class="bg-gradient-to-r from-primary-600 to-accent-600 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h2 class="text-3xl font-display font-bold text-white mb-4">
                Ne manquez aucun nouvel exposant
            </h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                Soyez informé en avant-première des nouveaux exposants qui rejoignent notre plateforme
            </p>
            
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto" x-data="{ email: '', loading: false }">
                <input type="email" 
                       x-model="email"
                       placeholder="Votre adresse email" 
                       class="flex-1 px-4 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50"
                       required>
                <button type="submit" 
                        :disabled="loading"
                        class="btn btn-secondary bg-white text-primary-600 hover:bg-white/90 px-6 py-3 font-semibold"
                        @click.prevent="
                            loading = true;
                            setTimeout(() => {
                                loading = false;
                                email = '';
                                alert('Merci pour votre inscription !');
                            }, 1000);
                        ">
                    <span x-show="!loading">S'abonner</span>
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
</div>
@endsection

<script>
function standsPage() {
    return {
        searchQuery: '',
        viewMode: 'grid',
        sortBy: 'recent',
        allStands: @json($stands->items()),
        filteredStands: @json($stands->items()),
        
        init() {
            // Préparer les données des stands
            this.allStands = this.allStands.map(stand => ({
                ...stand,
                nom_entreprise: stand.utilisateur?.nom_entreprise || 'Entreprise inconnue',
                products_count: stand.utilisateur?.products?.length || 0,
                created_at: new Date(stand.created_at).toLocaleDateString('fr-FR', { 
                    month: 'short', 
                    year: 'numeric' 
                }),
                searchText: (stand.nom_stand + ' ' + (stand.utilisateur?.nom_entreprise || '') + ' ' + stand.description).toLowerCase()
            }));
            
            this.filteredStands = [...this.allStands];
            this.sortStands();
        },
        
        filterStands() {
            if (this.searchQuery.trim() === '') {
                this.filteredStands = [...this.allStands];
            } else {
                const query = this.searchQuery.toLowerCase();
                this.filteredStands = this.allStands.filter(stand => 
                    stand.searchText.includes(query)
                );
            }
            this.sortStands();
        },
        
        clearSearch() {
            this.searchQuery = '';
            this.filterStands();
        },
        
        setSortBy(sortType) {
            this.sortBy = sortType;
            this.sortStands();
        },
        
        sortStands() {
            switch (this.sortBy) {
                case 'alphabetical':
                    this.filteredStands.sort((a, b) => a.nom_stand.localeCompare(b.nom_stand));
                    break;
                case 'recent':
                default:
                    this.filteredStands.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                    break;
            }
        },
        
        getSortLabel() {
            switch (this.sortBy) {
                case 'alphabetical':
                    return 'Alphabétique';
                case 'recent':
                default:
                    return 'Plus récents';
            }
        }
    }
}
</script>