@extends('layouts.app')

@section('title', 'Commande confirmée')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-accent-50 flex items-center justify-center py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <!-- Success Message -->
        <div class="card shadow-strong border-0 mb-8">
            <div class="card-body p-8 text-center">
                <!-- Success Icon -->
                <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-r from-success-400 to-success-500 rounded-3xl flex items-center justify-center shadow-soft">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                
                <h1 class="text-3xl font-display font-bold text-secondary-900 mb-4">
                    Merci pour votre commande !
                </h1>
                
                <p class="text-secondary-600 mb-6 leading-relaxed">
                    Votre commande a bien été enregistrée et sera traitée dans les plus brefs délais.
                </p>
                
                <!-- Order Number -->
                <div class="bg-gradient-to-r from-primary-50 to-accent-50 border border-primary-200 rounded-xl p-4 mb-6">
                    <div class="flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="text-primary-800 font-semibold">
                            Numéro de commande : <span class="font-mono">{{ $order->order_number }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Order Summary -->
        <div class="card shadow-soft mb-8">
            <div class="card-header p-6 border-b border-secondary-100">
                <h2 class="text-xl font-semibold text-secondary-900">Récapitulatif de votre commande</h2>
            </div>
            <div class="card-body p-0">
                <div class="divide-y divide-secondary-100">
                    @foreach($order->items as $item)
                        <div class="flex justify-between items-center p-6">
                            <div>
                                <span class="font-medium text-secondary-900">{{ $item->product->nom }}</span>
                                <span class="text-secondary-600 ml-2">x {{ $item->quantite }}</span>
                            </div>
                            <span class="font-semibold text-secondary-900">
                                {{ number_format($item->prix * $item->quantite, 2, ',', ' ') }} €
                            </span>
                        </div>
                    @endforeach
                    
                    <!-- Total -->
                    <div class="flex justify-between items-center p-6 bg-secondary-50">
                        <span class="text-lg font-bold text-secondary-900">Total</span>
                        <span class="text-lg font-bold text-success-600">
                            {{ number_format($order->total, 2, ',', ' ') }} €
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="text-center">
            <a href="{{ route('stands.public.index') }}" class="btn btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Retour à la vitrine
            </a>
        </div>
        
        <!-- Additional Info -->
        <div class="mt-8 text-center">
            <p class="text-secondary-600 text-sm">
                Vous recevrez un email de confirmation à l'adresse fournie lors de la commande.
            </p>
        </div>
    </div>
</div>
@endsection 