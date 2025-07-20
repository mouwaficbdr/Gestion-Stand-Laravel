@extends('layouts.app')

@section('title', 'À propos')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-orange-500 to-red-600 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-black opacity-20"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                À propos d'<span class="text-yellow-300">Eat&Drink</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                La plateforme qui révolutionne la découverte culinaire et soutient l'entrepreneuriat local
            </p>
        </div>
    </div>
</div>

<!-- Mission Section -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Mission</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Connecter les amateurs de cuisine avec les entrepreneurs culinaires passionnés, 
                créer une communauté gourmande et soutenir l'économie locale.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-3xl">🍽️</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Découverte Culinaire</h3>
                <p class="text-gray-600">
                    Explorez une diversité de saveurs authentiques et découvrez des talents culinaires 
                    cachés dans votre région.
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-3xl">🚀</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Soutien Entrepreneurial</h3>
                <p class="text-gray-600">
                    Donnons aux entrepreneurs culinaires les outils et la visibilité nécessaires 
                    pour développer leur activité.
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-3xl">🤝</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Communauté Locale</h3>
                <p class="text-gray-600">
                    Renforçons les liens communautaires en favorisant les échanges entre 
                    producteurs et consommateurs locaux.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Story Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Notre Histoire</h2>
                <div class="space-y-4 text-gray-600">
                    <p>
                        <strong class="text-orange-600">Eat&Drink</strong> est né d'une passion commune pour la gastronomie 
                        et d'une volonté de soutenir les entrepreneurs culinaires locaux. Nous avons constaté 
                        que de nombreux talents restaient dans l'ombre, faute de visibilité.
                    </p>
                    <p>
                        En 2024, nous avons décidé de créer une plateforme qui permettrait à ces artisans 
                        du goût de présenter leurs créations et de toucher un public plus large, tout en 
                        offrant aux gourmets une expérience de découverte unique.
                    </p>
                    <p>
                        Aujourd'hui, <strong class="text-orange-600">Eat&Drink</strong> rassemble une communauté 
                        grandissante d'entrepreneurs passionnés et d'amateurs de cuisine, créant un écosystème 
                        culinaire dynamique et authentique.
                    </p>
                </div>
            </div>
            
            <div class="relative">
                <div class="bg-gradient-to-r from-orange-400 to-red-500 rounded-lg p-8 text-white">
                    <div class="text-center">
                        <div class="text-6xl mb-4">📈</div>
                        <h3 class="text-2xl font-bold mb-4">Nos Chiffres</h3>
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div>
                                <div class="text-3xl font-bold">{{ $stats['stands'] ?? '50+' }}</div>
                                <div class="text-orange-100">Stands actifs</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold">{{ $stats['entrepreneurs'] ?? '30+' }}</div>
                                <div class="text-orange-100">Entrepreneurs</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold">{{ $stats['products'] ?? '200+' }}</div>
                                <div class="text-orange-100">Produits</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold">1000+</div>
                                <div class="text-orange-100">Visiteurs</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Values Section -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos Valeurs</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Les principes qui guident notre action au quotidien
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-orange-50 rounded-lg p-6 text-center">
                <div class="text-4xl mb-4">🌟</div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Qualité</h3>
                <p class="text-gray-600 text-sm">
                    Nous privilégions la qualité des produits et des expériences proposées.
                </p>
            </div>
            
            <div class="bg-green-50 rounded-lg p-6 text-center">
                <div class="text-4xl mb-4">🌱</div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Durabilité</h3>
                <p class="text-gray-600 text-sm">
                    Nous encourageons les pratiques respectueuses de l'environnement.
                </p>
            </div>
            
            <div class="bg-blue-50 rounded-lg p-6 text-center">
                <div class="text-4xl mb-4">🤝</div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Transparence</h3>
                <p class="text-gray-600 text-sm">
                    Nous favorisons la transparence entre entrepreneurs et consommateurs.
                </p>
            </div>
            
            <div class="bg-purple-50 rounded-lg p-6 text-center">
                <div class="text-4xl mb-4">💡</div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Innovation</h3>
                <p class="text-gray-600 text-sm">
                    Nous soutenons la créativité et l'innovation culinaire.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Team Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Équipe</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Une équipe passionnée dédiée au succès de votre expérience culinaire
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
                <div class="w-32 h-32 bg-gradient-to-r from-orange-400 to-red-500 rounded-full flex items-center justify-center text-white text-4xl font-bold mx-auto mt-6 mb-4">
                    M
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Marie Dubois</h3>
                    <p class="text-orange-600 font-medium mb-3">Fondatrice & CEO</p>
                    <p class="text-gray-600 text-sm">
                        Passionnée de gastronomie et d'entrepreneuriat, Marie a créé Eat&Drink 
                        pour connecter les talents culinaires avec leur public.
                    </p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
                <div class="w-32 h-32 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white text-4xl font-bold mx-auto mt-6 mb-4">
                    J
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Julien Martin</h3>
                    <p class="text-blue-600 font-medium mb-3">CTO</p>
                    <p class="text-gray-600 text-sm">
                        Expert en développement web, Julien assure la performance et 
                        l'évolution technique de la plateforme.
                    </p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
                <div class="w-32 h-32 bg-gradient-to-r from-green-400 to-teal-500 rounded-full flex items-center justify-center text-white text-4xl font-bold mx-auto mt-6 mb-4">
                    S
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Sophie Leroy</h3>
                    <p class="text-green-600 font-medium mb-3">Responsable Communauté</p>
                    <p class="text-gray-600 text-sm">
                        Sophie accompagne les entrepreneurs et anime la communauté 
                        pour créer des liens durables.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- How it works -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Comment ça marche ?</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Un processus simple pour découvrir et soutenir les talents culinaires locaux
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Pour les gourmets -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                    🍽️ Pour les Gourmets
                </h3>
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold mr-4 mt-1">1</div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Explorez les stands</h4>
                            <p class="text-gray-600 text-sm">Découvrez les stands culinaires près de chez vous</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold mr-4 mt-1">2</div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Découvrez les produits</h4>
                            <p class="text-gray-600 text-sm">Consultez les menus et spécialités de chaque stand</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold mr-4 mt-1">3</div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Rencontrez les entrepreneurs</h4>
                            <p class="text-gray-600 text-sm">Échangez directement avec les créateurs</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold mr-4 mt-1">4</div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Savourez et partagez</h4>
                            <p class="text-gray-600 text-sm">Dégustez et recommandez vos découvertes</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pour les entrepreneurs -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                    🚀 Pour les Entrepreneurs
                </h3>
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center font-bold mr-4 mt-1">1</div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Créez votre compte</h4>
                            <p class="text-gray-600 text-sm">Inscrivez-vous en tant qu'entrepreneur culinaire</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center font-bold mr-4 mt-1">2</div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Présentez vos stands</h4>
                            <p class="text-gray-600 text-sm">Créez des fiches détaillées pour vos points de vente</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center font-bold mr-4 mt-1">3</div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Ajoutez vos produits</h4>
                            <p class="text-gray-600 text-sm">Mettez en valeur votre offre culinaire</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center font-bold mr-4 mt-1">4</div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Développez votre activité</h4>
                            <p class="text-gray-600 text-sm">Gagnez en visibilité et fidélisez votre clientèle</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="bg-orange-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center text-white">
            <h2 class="text-3xl font-bold mb-4">Contactez-nous</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto text-orange-100">
                Une question ? Une suggestion ? Notre équipe est là pour vous accompagner !
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="text-3xl mb-2">📧</div>
                    <h3 class="font-semibold mb-1">Email</h3>
                    <p class="text-orange-100">contact@eatdrink.fr</p>
                </div>
                <div>
                    <div class="text-3xl mb-2">📱</div>
                    <h3 class="font-semibold mb-1">Téléphone</h3>
                    <p class="text-orange-100">01 23 45 67 89</p>
                </div>
                <div>
                    <div class="text-3xl mb-2">📍</div>
                    <h3 class="font-semibold mb-1">Adresse</h3>
                    <p class="text-orange-100">123 Rue de la Gastronomie<br>75001 Paris</p>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="mailto:contact@eatdrink.fr" class="bg-white text-orange-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition duration-200">
                    📧 Nous écrire
                </a>
                @guest
                    <a href="{{ route('register') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-orange-600 transition duration-200">
                        🚀 Rejoindre la communauté
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Questions Fréquentes</h2>
            <p class="text-gray-600">
                Trouvez rapidement les réponses à vos questions
            </p>
        </div>

        <div class="space-y-6" x-data="{ openFaq: null }">
            <div class="bg-white rounded-lg shadow-sm">
                <button @click="openFaq = openFaq === 1 ? null : 1" class="w-full px-6 py-4 text-left flex items-center justify-between">
                    <span class="font-medium text-gray-900">Comment devenir entrepreneur sur Eat&Drink ?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" :class="{ 'rotate-180': openFaq === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="openFaq === 1" x-collapse class="px-6 pb-4">
                    <p class="text-gray-600">
                        Il suffit de créer un compte en choisissant le rôle "Entrepreneur" lors de l'inscription. 
                        Votre demande sera examinée par notre équipe et vous recevrez une confirmation par email. 
                        Une fois approuvé, vous pourrez créer vos stands et ajouter vos produits.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm">
                <button @click="openFaq = openFaq === 2 ? null : 2" class="w-full px-6 py-4 text-left flex items-center justify-between">
                    <span class="font-medium text-gray-900">Eat&Drink est-il gratuit ?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" :class="{ 'rotate-180': openFaq === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="openFaq === 2" x-collapse class="px-6 pb-4">
                    <p class="text-gray-600">
                        Oui ! L'utilisation d'Eat&Drink est entièrement gratuite, que vous soyez un amateur de cuisine 
                        à la recherche de nouvelles découvertes ou un entrepreneur souhaitant présenter ses créations.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm">
                <button @click="openFaq = openFaq === 3 ? null : 3" class="w-full px-6 py-4 text-left flex items-center justify-between">
                    <span class="font-medium text-gray-900">Comment puis-je contacter un entrepreneur ?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" :class="{ 'rotate-180': openFaq === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="openFaq === 3" x-collapse class="px-6 pb-4">
                    <p class="text-gray-600">
                        Sur chaque fiche de stand, vous trouverez les informations de contact de l'entrepreneur 
                        (téléphone, email). Vous pouvez également laisser un like pour montrer votre intérêt.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm">
                <button @click="openFaq = openFaq === 4 ? null : 4" class="w-full px-6 py-4 text-left flex items-center justify-between">
                    <span class="font-medium text-gray-900">Puis-je modifier mes informations après inscription ?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" :class="{ 'rotate-180': openFaq === 4 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="openFaq === 4" x-collapse class="px-6 pb-4">
                    <p class="text-gray-600">
                        Bien sûr ! Vous pouvez modifier vos informations personnelles, vos stands et vos produits 
                        à tout moment depuis votre espace personnel. Vos modifications sont prises en compte immédiatement.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection