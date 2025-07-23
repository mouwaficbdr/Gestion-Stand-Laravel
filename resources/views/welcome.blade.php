@extends('layouts.app')

@section('content')
<!-- Hero -->
<div class="relative bg-gradient-to-r from-orange-500 to-red-600 overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                Découvrez les Saveurs 
                <br>de Votre Région
            </h1>
            <p class="text-xl md:text-2xl text-white mb-8 max-w-3xl mx-auto">
                Rejoignez la plateforme culinaire incontournable qui rassemble les meilleurs producteurs locaux, restaurants et créateurs de votre région
            </p>
            <div class="space-x-4">
                <a href="{{ route('stands.index') }}" class="bg-white text-orange-600 px-8 py-3 rounded-md text-lg font-semibold hover:bg-gray-100 transition duration-300">
                    Explorer les stands
                </a>
                @guest
                    <a href="{{ route('register') }}" class="border-2 border-white text-white px-8 py-3 rounded-md text-lg font-semibold hover:bg-white hover:text-orange-600 transition duration-300">
                        Devenir exposant
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>

<!-- Stats -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div class="bg-orange-50 p-8 rounded-lg">
                <div class="text-4xl font-bold text-orange-600 mb-2">{{ $stands->count() }}+</div>
                <div class="text-gray-600">Exposants confirmés</div>
            </div>
            <div class="bg-red-50 p-8 rounded-lg">
                <div class="text-4xl font-bold text-red-600 mb-2">{{ $stands->sum('views') }}+</div>
                <div class="text-gray-600">Visiteurs attendus</div>
            </div>
            <div class="bg-green-50 p-8 rounded-lg">
                <div class="text-4xl font-bold text-green-600 mb-2">{{ $stands->sum(function($stand) { return $stand->products->count(); }) }}+</div>
                <div class="text-gray-600">Catégories de produits</div>
            </div>
            <div class="bg-blue-50 p-8 rounded-lg">
                <div class="text-4xl font-bold text-blue-600 mb-2">{{ $stands->sum(function($stand) { return $stand->products->count(); }) }}+</div>
                <div class="text-gray-600">Jours d'ouverture</div>
            </div>
            
        </div>
    </div>
</div>

<!-- les Stands -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Nos Exposants Vedettes
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Découvrez quelques-uns des exposants exceptionnels qui participent à notre plateforme
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($stands as $stand)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    @if($stand->image)
                        <img src="{{ Storage::url($stand->image) }}" alt="{{ $stand->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-r from-orange-400 to-red-500 flex items-center justify-center">
                            <span class="text-white text-2xl font-bold">{{ substr($stand->name, 0, 1) }}</span>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $stand->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($stand->description, 100) }}</p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm text-gray-500">Par {{ $stand->user->name }}</span>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span>👁 {{ $stand->views }}</span>
                                <span>❤️ {{ $stand->likes }}</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-orange-600 font-medium">{{ $stand->products->count() }} produits</span>
                            <a href="{{ route('stands.show', $stand) }}" class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700 transition duration-300">
                                Voir le stand
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">Aucun stand disponible pour le moment.</p>
                </div>
            @endforelse
        </div>

        @if($stands->count() > 0)
            <div class="text-center mt-12">
                <a href="{{ route('stands.index') }}" class="bg-orange-600 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-orange-700 transition duration-300">
                    Voir tous les Exposants
                </a>
            </div>
        @endif
    </div>
</div>

<!-- le login -->
<div class="bg-gradient-to-r from-orange-600 to-red-600 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
            Vous êtes un Producteur Local ?
        </h2>
        <p class="text-xl text-white mb-8 max-w-2xl mx-auto">
            Rejoignez notre communauté d'exposants et faites découvrir vos produits à des milliers de visiteurs.
        </p>
        @guest
            <a href="{{ route('register') }}" class="bg-white text-orange-600 px-8 py-3 rounded-md text-lg font-semibold hover:bg-gray-100 transition duration-300 pd">
                Postuler comme exposant
            </a>
            <a href="{{ route('about') }}" class="bg-white text-orange-600 px-8 py-3 rounded-md text-lg font-semibold hover:bg-gray-100 transition duration-300">
                En savoir plus
            </a>
        @endguest
    </div>
</div>
@endsection