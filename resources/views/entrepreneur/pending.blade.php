@extends('layouts.app')

@section('title', 'Demande en cours - Eat&Drink')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-accent-50 flex items-center justify-center py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="card shadow-strong border-0">
            <div class="card-body p-8 text-center">
                <!-- Icon -->
                <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-r from-warning-400 to-warning-500 rounded-3xl flex items-center justify-center shadow-soft">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                
                <h1 class="text-3xl font-display font-bold text-secondary-900 mb-4">
                    Demande en cours de validation
                </h1>
                
                <p class="text-xl text-secondary-700 mb-6">
                    Bonjour <strong class="text-primary-600">{{ auth()->user()->nom }}</strong>,
                </p>
                
                <p class="text-secondary-600 mb-8 leading-relaxed">
                    Votre demande de participation à l'événement Eat&Drink a bien été reçue et est actuellement 
                    en cours d'examen par notre équipe.
                </p>
                
                <!-- Information Card -->
                <div class="bg-gradient-to-r from-info-50 to-primary-50 border border-info-200 rounded-xl p-6 mb-8">
                    <div class="flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-info-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-info-800">Informations de votre demande</h3>
                    </div>
                    <div class="space-y-2 text-left">
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-secondary-700">Entreprise :</span>
                            <span class="text-secondary-900">{{ auth()->user()->nom_entreprise }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-secondary-700">Stand :</span>
                            <span class="text-secondary-900">{{ auth()->user()->stand->nom_stand ?? 'Non défini' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-secondary-700">Date de soumission :</span>
                            <span class="text-secondary-900">{{ auth()->user()->created_at->format('d/m/Y à H:i') }}</span>
                        </div>
                    </div>
                </div>
                
                <p class="text-secondary-600 mb-8 leading-relaxed">
                    Vous recevrez une notification par email dès que votre demande sera traitée. 
                    En cas d'approbation, vous pourrez accéder à votre espace exposant.
                </p>
                
                <!-- Process Steps -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-2 bg-success-500 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-success-600">Demande soumise</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-2 bg-warning-500 rounded-full flex items-center justify-center animate-pulse">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-warning-600">En cours d'examen</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-2 bg-secondary-300 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-secondary-500">Validation finale</p>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}" class="btn btn-secondary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Retour à l'accueil
                    </a>
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Se déconnecter
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
