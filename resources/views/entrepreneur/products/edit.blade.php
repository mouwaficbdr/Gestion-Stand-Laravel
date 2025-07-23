@extends('layouts.app')

@section('title', 'Modifier le produit')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-accent-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-display font-bold text-secondary-900">Modifier le produit</h1>
        </div>
        
        <div class="card shadow-strong">
            <div class="card-body p-8">
                <form action="{{ route('entrepreneur.products.update', $product) }}" 
                      method="POST" 
                      enctype="multipart/form-data" 
                      class="space-y-6"
                      @submit="loading = true"
                      x-data="{ loading: false, imagePreview: null }">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="nom" class="form-label">Nom du produit</label>
                        <input type="text" 
                               name="nom" 
                               id="nom" 
                               class="form-input @error('nom') border-danger-300 focus:ring-danger-500 focus:border-danger-500 @enderror" 
                               value="{{ old('nom', $product->nom) }}" 
                               required>
                        @error('nom')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" 
                                  id="description" 
                                  class="form-input @error('description') border-danger-300 focus:ring-danger-500 focus:border-danger-500 @enderror" 
                                  rows="4" 
                                  required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="prix" class="form-label">Prix (€)</label>
                        <input type="number" 
                               name="prix" 
                               id="prix" 
                               class="form-input @error('prix') border-danger-300 focus:ring-danger-500 focus:border-danger-500 @enderror" 
                               value="{{ old('prix', $product->prix) }}" 
                               step="0.01" 
                               min="0" 
                               required>
                        @error('prix')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="photo" class="form-label">Photo</label>
                        @if($product->photo)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $product->photo) }}" 
                                     alt="Photo actuelle" 
                                     class="w-20 h-20 object-cover rounded-lg shadow-soft">
                            </div>
                        @endif
                        <input type="file" 
                               name="photo" 
                               id="photo" 
                               class="form-input @error('photo') border-danger-300 focus:ring-danger-500 focus:border-danger-500 @enderror" 
                               accept="image/*"
                               @change="
                                   const file = $event.target.files[0];
                                   if (file) {
                                       const reader = new FileReader();
                                       reader.onload = e => imagePreview = e.target.result;
                                       reader.readAsDataURL(file);
                                   }
                               ">
                        @error('photo')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                        
                        <!-- Preview -->
                        <div x-show="imagePreview" class="mt-4">
                            <img :src="imagePreview" 
                                 alt="Aperçu" 
                                 class="w-20 h-20 object-cover rounded-lg shadow-soft">
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <a href="{{ route('entrepreneur.products.index') }}" 
                           class="btn btn-secondary flex-1 text-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Annuler
                        </a>
                        
                        <button type="submit" 
                                :disabled="loading"
                                class="btn btn-primary flex-1">
                            <span x-show="!loading" class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Enregistrer
                            </span>
                            <span x-show="loading" class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Enregistrement...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 