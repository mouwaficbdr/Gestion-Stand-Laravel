@extends('layouts.app')

@section('title', 'Devenir Exposant - Eat&Drink')
@section('description', 'Rejoignez notre communauté d\'exposants et faites découvrir vos créations culinaires à des milliers de visiteurs.')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-accent-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="flex items-center justify-center space-x-2 mb-6">
                <div class="w-12 h-12 gradient-hero rounded-xl flex items-center justify-center shadow-glow">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <span class="text-2xl font-display font-bold text-gradient">Eat&Drink</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-display font-bold text-secondary-900 mb-4">
                Devenez Exposant
            </h1>
            <p class="text-xl text-secondary-600 max-w-2xl mx-auto leading-relaxed">
                Rejoignez notre communauté d'exposants et faites découvrir vos créations culinaires 
                à des milliers de visiteurs passionnés lors de notre événement.
            </p>
        </div>

        <!-- Progress Steps -->
        <div class="mb-12" x-data="{ currentStep: 1 }">
            <div class="flex items-center justify-center space-x-8">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-primary-500 text-white rounded-full flex items-center justify-center font-semibold shadow-soft">
                        1
                    </div>
                    <span class="ml-3 text-sm font-medium text-primary-600">Informations personnelles</span>
                </div>
                <div class="w-16 h-0.5 bg-secondary-200"></div>
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-secondary-200 text-secondary-500 rounded-full flex items-center justify-center font-semibold">
                        2
                    </div>
                    <span class="ml-3 text-sm font-medium text-secondary-500">Informations du stand</span>
                </div>
                <div class="w-16 h-0.5 bg-secondary-200"></div>
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-secondary-200 text-secondary-500 rounded-full flex items-center justify-center font-semibold">
                        3
                    </div>
                    <span class="ml-3 text-sm font-medium text-secondary-500">Validation</span>
                </div>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="card shadow-strong border-0">
            <div class="card-body p-8">


                <form method="POST" action="{{ route('register') }}" class="space-y-8" x-data="{ loading: false, step: 1 }"
                      @submit="loading = true">
                    @csrf
                    
                    <!-- Step 1: Personal Information -->
                    <div class="space-y-6">
                        <div class="border-b border-secondary-200 pb-4">
                            <h3 class="text-lg font-semibold text-secondary-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Informations personnelles
                            </h3>
                            <p class="text-secondary-600 mt-1">Renseignez vos informations de contact</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nom" class="form-label">
                                    Nom complet *
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" 
                                           id="nom" 
                                           name="nom" 
                                           value="{{ old('nom') }}" 
                                           class="form-input pl-10 @error('nom') border-danger-300 focus:ring-danger-500 focus:border-danger-500 @enderror" 
                                           placeholder="Jean Dupont"
                                           required>
                                </div>
                                @error('nom')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="nom_entreprise" class="form-label">
                                    Nom de l'entreprise *
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <input type="text" 
                                           id="nom_entreprise" 
                                           name="nom_entreprise" 
                                           value="{{ old('nom_entreprise') }}" 
                                           class="form-input pl-10 @error('nom_entreprise') border-danger-300 focus:ring-danger-500 focus:border-danger-500 @enderror" 
                                           placeholder="Ma Belle Entreprise"
                                           required>
                                </div>
                                @error('nom_entreprise')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="email" class="form-label">
                                Adresse email professionnelle *
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       class="form-input pl-10 @error('email') border-danger-300 focus:ring-danger-500 focus:border-danger-500 @enderror" 
                                       placeholder="contact@monentreprise.com"
                                       required>
                            </div>
                            @error('email')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="password" class="form-label">
                                    Mot de passe *
                                </label>
                                <div class="relative" x-data="{ showPassword: false }">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <input :type="showPassword ? 'text' : 'password'" 
                                           id="password" 
                                           name="password" 
                                           class="form-input pl-10 pr-10 @error('password') border-danger-300 focus:ring-danger-500 focus:border-danger-500 @enderror" 
                                           placeholder="••••••••"
                                           required>
                                    <button type="button" 
                                            @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg x-show="!showPassword" class="h-5 w-5 text-secondary-400 hover:text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg x-show="showPassword" class="h-5 w-5 text-secondary-400 hover:text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="form-label">
                                    Confirmer le mot de passe *
                                </label>
                                <div class="relative" x-data="{ showPassword: false }">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <input :type="showPassword ? 'text' : 'password'" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           class="form-input pl-10 pr-10" 
                                           placeholder="••••••••"
                                           required>
                                    <button type="button" 
                                            @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg x-show="!showPassword" class="h-5 w-5 text-secondary-400 hover:text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg x-show="showPassword" class="h-5 w-5 text-secondary-400 hover:text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Stand Information -->
                    <div class="space-y-6">
                        <div class="border-b border-secondary-200 pb-4">
                            <h3 class="text-lg font-semibold text-secondary-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Informations de votre stand
                            </h3>
                            <p class="text-secondary-600 mt-1">Décrivez votre activité et votre concept</p>
                        </div>

                        <div>
                            <label for="nom_stand" class="form-label">
                                Nom de votre stand *
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <input type="text" 
                                       id="nom_stand" 
                                       name="nom_stand" 
                                       value="{{ old('nom_stand') }}" 
                                       class="form-input pl-10 @error('nom_stand') border-danger-300 focus:ring-danger-500 focus:border-danger-500 @enderror" 
                                       placeholder="Les Délices du Terroir"
                                       required>
                            </div>
                            @error('nom_stand')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-secondary-500">Ce nom apparaîtra sur votre vitrine publique</p>
                        </div>

                        <div>
                            <label for="description" class="form-label">
                                Description de votre activité *
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="6" 
                                      class="form-input @error('description') border-danger-300 focus:ring-danger-500 focus:border-danger-500 @enderror" 
                                      placeholder="Décrivez votre spécialité, vos produits, votre concept, votre histoire... Cette description aidera les visiteurs à découvrir votre univers culinaire."
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-secondary-500">Minimum 50 caractères. Soyez précis et engageant !</p>
                        </div>
                    </div>

                    <!-- Terms and Submit -->
                    <div class="space-y-6">
                        <div class="bg-secondary-50 rounded-lg p-6">
                            <div class="flex items-start space-x-3">
                                <input id="terms" 
                                       name="terms" 
                                       type="checkbox" 
                                       class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-secondary-300 rounded mt-1"
                                       required>
                                <label for="terms" class="text-sm text-secondary-700 leading-relaxed">
                                    J'accepte les <a href="#" class="text-primary-600 hover:text-primary-500 font-medium">conditions générales d'utilisation</a> 
                                    et la <a href="#" class="text-primary-600 hover:text-primary-500 font-medium">politique de confidentialité</a>. 
                                    Je comprends que ma demande sera examinée par l'équipe Eat&Drink avant validation.
                                </label>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <button type="submit" 
                                    :disabled="loading"
                                    class="btn btn-primary flex-1 py-4 text-lg font-semibold">
                                <span x-show="!loading" class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Soumettre ma candidature
                                </span>
                                <span x-show="loading" class="flex items-center justify-center">
                                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Envoi en cours...
                                </span>
                            </button>
                            
                            <a href="{{ route('login') }}" 
                               class="btn btn-secondary flex-1 py-4 text-lg font-semibold text-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                J'ai déjà un compte
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Process Information -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center shadow-soft">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-secondary-900 mb-2">1. Candidature</h3>
                <p class="text-secondary-600">Soumettez votre dossier complet avec vos informations et la description de votre activité.</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-accent-500 to-accent-600 rounded-2xl flex items-center justify-center shadow-soft">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-secondary-900 mb-2">2. Validation</h3>
                <p class="text-secondary-600">Notre équipe examine votre candidature sous 48h et vous contacte pour finaliser votre participation.</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-success-500 to-success-600 rounded-2xl flex items-center justify-center shadow-soft">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-secondary-900 mb-2">3. Lancement</h3>
                <p class="text-secondary-600">Accédez à votre espace exposant, ajoutez vos produits et préparez-vous pour l'événement !</p>
            </div>
        </div>
    </div>
</div>
@endsection
