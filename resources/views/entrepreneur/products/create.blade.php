@extends('layouts.app')

@section('title', 'Ajouter un produit - Eat&Drink')
@section('description', 'Ajoutez un nouveau produit à votre catalogue pour votre stand Eat&Drink')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-accent-50">
    <!-- Header -->
    <div class="bg-white shadow-soft border-b border-secondary-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('entrepreneur.products.index') }}" 
                   class="p-2 rounded-lg hover:bg-secondary-100 transition-colors duration-200">
                    <svg class="w-5 h-5 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-display font-bold text-secondary-900 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-primary-500 to-accent-500 rounded-xl flex items-center justify-center mr-3 shadow-glow">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        Ajouter un produit
                    </h1>
                    <p class="text-secondary-600 mt-1">Créez un nouveau produit pour votre stand</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Tips Card -->
        <div class="card mb-8 bg-gradient-to-r from-primary-50 to-accent-50 border-primary-200">
            <div class="card-body p-6">
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 bg-gradient-to-r from-primary-500 to-accent-500 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-secondary-900 mb-2">Conseils pour un produit attractif</h3>
                        <ul class="text-sm text-secondary-600 space-y-1">
                            <li>• Utilisez un nom accrocheur et descriptif</li>
                            <li>• Ajoutez une photo de qualité (recommandé : 800x600px minimum)</li>
                            <li>• Décrivez les ingrédients, la méthode de préparation et les allergènes</li>
                            <li>• Fixez un prix compétitif en étudiant le marché</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Form -->
        <div class="card shadow-strong">
            <div class="card-body p-8">
                <form action="{{ route('entrepreneur.products.store') }}" 
                      method="POST" 
                      enctype="multipart/form-data" 
                      class="space-y-8"
                      @submit="loading = true"
                      x-data="{ 
                        loading: false, 
                        imagePreview: null,
                        dragOver: false,
                        handleImageChange(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    this.imagePreview = e.target.result;
                                };
                                reader.readAsDataURL(file);
                            }
                        },
                        handleDrop(event) {
                            event.preventDefault();
                            this.dragOver = false;
                            const files = event.dataTransfer.files;
                            if (files.length > 0) {
                                const file = files[0];
                                if (file.type.startsWith('image/')) {
                                    document.getElementById('photo').files = files;
                                    this.handleImageChange({ target: { files: [file] } });
                                }
                            }
                        }
                      }">
                    @csrf
                    
                    <!-- Product Name -->
                    <div>
                        <label for="nom" class="form-label">
                            Nom du produit *
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   id="nom" 
                                   name="nom" 
                                   value="{{ old('nom') }}" 
                                   class="form-input pl-10 @error('nom') border-danger-300 focus:ring-danger-500 focus:border-danger-500 @enderror" 
                                   placeholder="Ex: Tarte aux pommes maison"
                                   required>
                        </div>
                        @error('nom')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-secondary-500">Choisissez un nom attractif et descriptif</p>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="form-label">
                            Description détaillée *
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="6" 
                                  class="form-input @error('description') border-danger-300 focus:ring-danger-500 focus:border-danger-500 @enderror" 
                                  placeholder="Décrivez votre produit : ingrédients, méthode de préparation, origine, allergènes, conseils de dégustation..."
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-secondary-500">Plus votre description est détaillée, plus elle attirera les clients</p>
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="prix" class="form-label">
                            Prix de vente *
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <input type="number" 
                                   id="prix" 
                                   name="prix" 
                                   value="{{ old('prix') }}" 
                                   class="form-input pl-10 pr-12 @error('prix') border-danger-300 focus:ring-danger-500 focus:border-danger-500 @enderror" 
                                   placeholder="0.00"
                                   step="0.01" 
                                   min="0" 
                                   required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-secondary-500 text-sm">€</span>
                            </div>
                        </div>
                        @error('prix')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-secondary-500">Fixez un prix compétitif en étudiant le marché local</p>
                    </div>

                    <!-- Photo Upload -->
                    <div>
                        <label for="photo" class="form-label">
                            Photo du produit
                        </label>
                        
                        <!-- Upload Area -->
                        <div class="mt-2">
                            <div @dragover.prevent="dragOver = true"
                                 @dragleave.prevent="dragOver = false"
                                 @drop.prevent="handleDrop"
                                 :class="dragOver ? 'border-primary-400 bg-primary-50' : 'border-secondary-300'"
                                 class="relative border-2 border-dashed rounded-xl p-8 text-center hover:border-primary-400 hover:bg-primary-50 transition-all duration-300">
                                
                                <!-- Preview Image -->
                                <div x-show="imagePreview" class="mb-4">
                                    <img :src="imagePreview" 
                                         alt="Aperçu" 
                                         class="mx-auto h-32 w-32 object-cover rounded-lg shadow-soft">
                                </div>

                                <!-- Upload Icon and Text -->
                                <div x-show="!imagePreview">
                                    <svg class="mx-auto h-12 w-12 text-secondary-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-secondary-600 mb-2">
                                        <span class="font-medium">Cliquez pour télécharger</span> ou glissez-déposez
                                    </p>
                                    <p class="text-sm text-secondary-500">PNG, JPG, JPEG jusqu'à 5MB</p>
                                </div>

                                <!-- Hidden File Input -->
                                <input type="file" 
                                       id="photo" 
                                       name="photo" 
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                       accept="image/*"
                                       @change="handleImageChange">
                            </div>
                        </div>
                        
                        @error('photo')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-secondary-500">
                            Une belle photo augmente vos ventes de 300% ! Recommandé : 800x600px minimum
                        </p>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-secondary-200">
                        <a href="{{ route('entrepreneur.products.index') }}" 
                           class="btn btn-secondary flex-1 py-3 text-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Annuler
                        </a>
                        
                        <button type="submit" 
                                :disabled="loading"
                                class="btn btn-primary flex-1 py-3 font-semibold shadow-glow hover:shadow-strong">
                            <span x-show="!loading" class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Ajouter le produit
                            </span>
                            <span x-show="loading" class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Création en cours...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Additional Tips -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="card">
                <div class="card-body p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-success-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-secondary-900">Bonnes pratiques</h3>
                    </div>
                    <ul class="text-sm text-secondary-600 space-y-2">
                        <li>• Mentionnez les allergènes obligatoires</li>
                        <li>• Indiquez la provenance des ingrédients</li>
                        <li>• Précisez les conditions de conservation</li>
                        <li>• Ajoutez des mots-clés pour la recherche</li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-secondary-900">Photo parfaite</h3>
                    </div>
                    <ul class="text-sm text-secondary-600 space-y-2">
                        <li>• Éclairage naturel de préférence</li>
                        <li>• Fond neutre et propre</li>
                        <li>• Produit centré et net</li>
                        <li>• Format paysage recommandé</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 