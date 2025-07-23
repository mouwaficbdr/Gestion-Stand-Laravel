@extends('layouts.app')

@section('title', $stand->nom_stand . ' - Eat&Drink')
@section('description', 'Découvrez ' . $stand->nom_stand . ' et ses produits culinaires uniques. ' . Str::limit($stand->description, 120))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-accent-50">
    <!-- Breadcrumb -->
    <div class="bg-white shadow-soft border-b border-secondary-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center space-x-2 text-sm text-secondary-600">
                <a href="{{ route('home') }}" class="hover:text-primary-600 transition-colors duration-200">Accueil</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('stands.public.index') }}" class="hover:text-primary-600 transition-colors duration-200">Exposants</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-secondary-900 font-medium">{{ $stand->nom_stand }}</span>
            </nav>
        </div>
    </div>

    <!-- Stand Header -->
    <div class="bg-gradient-to-r from-primary-600 via-primary-500 to-accent-500 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute inset-0">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl animate-float"></div>
            <div class="absolute bottom-10 right-10 w-48 h-48 bg-white/5 rounded-full blur-3xl animate-float" style="animation-delay: -3s;"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="flex flex-col lg:flex-row items-start lg:items-center space-y-6 lg:space-y-0 lg:space-x-8">
                <!-- Stand Avatar -->
                <div class="flex-shrink-0">
                    <div class="w-32 h-32 bg-white/20 backdrop-blur-sm rounded-3xl flex items-center justify-center shadow-strong">
                        @if($stand->image ?? false)
                            <img src="{{ asset('storage/' . $stand->image) }}" 
                                 alt="{{ $stand->nom_stand }}" 
                                 class="w-full h-full object-cover rounded-3xl">
                        @else
                            <span class="text-5xl font-bold text-white">{{ substr($stand->nom_stand, 0, 1) }}</span>
                        @endif
                    </div>
                </div>

                <!-- Stand Info -->
                <div class="flex-1 text-white">
                    <div class="flex items-center space-x-3 mb-2">
                        <h1 class="text-4xl md:text-5xl font-display font-bold">{{ $stand->nom_stand }}</h1>
                        <span class="badge badge-success bg-white/20 backdrop-blur-sm border-white/30 text-white">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Vérifié
                        </span>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-6 mb-4 text-white/90">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span class="font-medium">{{ $stand->utilisateur->nom_entreprise }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>{{ $stand->utilisateur->nom }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Membre depuis {{ $stand->created_at->format('M Y') }}</span>
                        </div>
                    </div>

                    <p class="text-xl text-white/90 leading-relaxed mb-6 max-w-3xl">
                        {{ $stand->description }}
                    </p>

                    <!-- Stats -->
                    <div class="flex flex-wrap items-center gap-6 text-sm">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <span><strong>{{ $products->count() }}</strong> produits</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>

                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Section Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-display font-bold text-secondary-900 mb-2">
                    Nos Produits
                </h2>
                <p class="text-secondary-600">
                    Découvrez notre sélection de {{ $products->count() }} produits artisanaux
                </p>
            </div>

            <!-- Filters -->
            <div class="flex items-center space-x-4">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" 
                            class="flex items-center space-x-2 px-4 py-2 bg-white border border-secondary-300 rounded-lg hover:bg-secondary-50 transition-colors duration-200">
                        <svg class="w-4 h-4 text-secondary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        <span class="text-sm text-secondary-700">Filtrer</span>
                        <svg class="w-4 h-4 text-secondary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         @click.away="open = false"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-strong border border-secondary-100 py-2 z-10"
                         style="display: none;">
                        <a href="#" class="block px-4 py-2 text-sm text-secondary-700 hover:bg-secondary-50">Prix croissant</a>
                        <a href="#" class="block px-4 py-2 text-sm text-secondary-700 hover:bg-secondary-50">Prix décroissant</a>
                        <a href="#" class="block px-4 py-2 text-sm text-secondary-700 hover:bg-secondary-50">Nouveautés</a>
                    </div>
                </div>
            </div>
        </div>

        @if($products->count() > 0)
            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                <div class="group" x-data="{ quantity: 1, adding: false }">
                    <div class="card card-hover h-full overflow-hidden">
                        <!-- Product Image -->
                        <div class="relative h-48 bg-gradient-to-br from-secondary-100 to-secondary-200 overflow-hidden">
                            @if($product->photo)
                                <img src="{{ asset('storage/' . $product->photo) }}" 
                                     alt="{{ $product->nom }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Quick Actions Overlay -->
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <button class="btn btn-secondary btn-sm bg-white/20 backdrop-blur-sm border-white/30 text-white hover:bg-white/30">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Price Badge -->
                            <div class="absolute top-4 right-4">
                                <span class="bg-white/90 backdrop-blur-sm text-secondary-900 px-3 py-1 rounded-full text-sm font-semibold shadow-soft">
                                    {{ number_format($product->prix, 2, ',', ' ') }} €
                                </span>
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="card-body p-4">
                            <h3 class="text-lg font-semibold text-secondary-900 mb-2 group-hover:text-primary-600 transition-colors duration-200">
                                {{ $product->nom }}
                            </h3>
                            
                            <p class="text-secondary-600 text-sm leading-relaxed mb-4">
                                {{ Str::limit($product->description, 80) }}
                            </p>

                            <!-- Add to Cart -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" 
                                  @submit.prevent="
                                    adding = true;
                                    fetch('{{ route('cart.add', $product->id) }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({ quantite: quantity })
                                    }).then(() => {
                                        adding = false;
                                        // Update cart counter
                                        window.dispatchEvent(new CustomEvent('cart-updated'));
                                    });
                                  ">
                                @csrf
                                <div class="flex items-center space-x-2">
                                    <!-- Quantity Selector -->
                                    <div class="flex items-center border border-secondary-300 rounded-lg">
                                        <button type="button" 
                                                @click="quantity = Math.max(1, quantity - 1)"
                                                class="p-2 hover:bg-secondary-50 transition-colors duration-200">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <input type="number" 
                                               name="quantite" 
                                               x-model="quantity"
                                               min="1" 
                                               class="w-12 text-center border-0 focus:ring-0 text-sm">
                                        <button type="button" 
                                                @click="quantity = quantity + 1"
                                                class="p-2 hover:bg-secondary-50 transition-colors duration-200">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Add Button -->
                                    <button type="submit" 
                                            :disabled="adding"
                                            class="btn btn-primary flex-1 py-2 text-sm font-semibold group-hover:shadow-glow transition-all duration-300">
                                        <span x-show="!adding" class="flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                            Ajouter
                                        </span>
                                        <span x-show="adding" class="flex items-center justify-center">
                                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Ajout...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-r from-secondary-100 to-secondary-200 rounded-2xl flex items-center justify-center">
                    <svg class="w-12 h-12 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold text-secondary-900 mb-4">Aucun produit disponible</h3>
                <p class="text-secondary-600 mb-8 max-w-md mx-auto">
                    Ce stand n'a pas encore ajouté de produits. Revenez bientôt pour découvrir ses créations !
                </p>
                <a href="{{ route('stands.public.index') }}" class="btn btn-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Découvrir d'autres stands
                </a>
            </div>
        @endif
    </div>

    <!-- Related Stands -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-display font-bold text-secondary-900 mb-4">
                    Autres exposants à découvrir
                </h2>
                <p class="text-secondary-600 max-w-2xl mx-auto">
                    Explorez d'autres stands qui pourraient vous intéresser
                </p>
            </div>

            @if($relatedStands->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedStands as $relatedStand)
                    <div class="card card-hover group">
                        <div class="relative h-32 bg-gradient-to-br from-primary-400 to-accent-500 overflow-hidden">
                            @if($relatedStand->image)
                                <img src="{{ asset('storage/' . $relatedStand->image) }}" 
                                     alt="{{ $relatedStand->nom_stand }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-3xl font-bold text-white">{{ substr($relatedStand->nom_stand, 0, 1) }}</span>
                                </div>
                            @endif
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="card-body p-4">
                            <h3 class="font-semibold text-secondary-900 mb-2">{{ $relatedStand->nom_stand }}</h3>
                            <p class="text-sm text-secondary-600 mb-1">{{ $relatedStand->utilisateur->nom_entreprise }}</p>
                            <p class="text-sm text-secondary-600 mb-3">{{ Str::limit($relatedStand->description, 80) }}</p>
                            <a href="{{ route('stands.public.show', $relatedStand->id) }}" 
                               class="btn btn-secondary btn-sm w-full group-hover:shadow-soft transition-all duration-300">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Découvrir
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-secondary-600">Aucun autre exposant disponible pour le moment.</p>
                </div>
            @endif

            <div class="text-center mt-8">
                <a href="{{ route('stands.public.index') }}" class="btn btn-primary">
                    Voir tous les exposants
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 