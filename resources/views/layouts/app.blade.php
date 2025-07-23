<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Eat&Drink - Plateforme Culinaire Moderne')</title>
    <meta name="description" content="@yield('description', 'Découvrez la plateforme culinaire incontournable avec les meilleurs chefs et producteurs locaux.')">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Preload critical fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" as="style">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 bg-white/95 backdrop-blur-md shadow-soft border-b border-secondary-100" 
         x-data="{ open: false }">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                        <div class="w-10 h-10 gradient-hero rounded-xl flex items-center justify-center shadow-glow group-hover:scale-105 transition-transform duration-200">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.1 13.34l2.83-2.83L3.91 3.5c-1.56 1.56-1.56 4.09 0 5.66l4.19 4.18zm6.78-1.81c1.53.71 3.68.21 5.27-1.38 1.91-1.91 2.28-4.65.81-6.12-1.46-1.46-4.20-1.10-6.12.81-1.59 1.59-2.09 3.74-1.38 5.27L3.7 19.87l1.41 1.41L12 14.41l6.88 6.88 1.41-1.41L13.41 13l1.47-1.47z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-display font-bold text-gradient">Eat&Drink</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        Accueil
                    </a>
                    <a href="{{ route('stands.public.index') }}" class="nav-link {{ request()->routeIs('stands.public.*') ? 'active' : '' }}">
                        Exposants
                    </a>
                    
                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="nav-link flex items-center {{ request()->routeIs('cart.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Panier
                    </a>
                </div>

                <!-- Auth Section -->
                <div class="hidden md:flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="nav-link">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            Devenir Exposant
                        </a>
                    @else
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ userOpen: false }">
                            <button @click="userOpen = !userOpen" 
                                    class="flex items-center space-x-2 p-2 rounded-lg hover:bg-white/10 transition-colors duration-200">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary-500 to-accent-500 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-medium">{{ substr(auth()->user()->nom, 0, 1) }}</span>
                                </div>
                                <span class="text-sm font-medium text-secondary-700">{{ auth()->user()->nom }}</span>
                                <svg class="w-4 h-4 text-secondary-500 transition-transform duration-200" 
                                     :class="userOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div x-show="userOpen" 
                                 x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 @click.away="userOpen = false"
                                 class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-strong border border-secondary-100 py-2"
                                 style="display: none;">
                                
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-sm text-secondary-700 hover:bg-primary-50 hover:text-primary-600 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                        Administration
                                    </a>
                                @elseif(auth()->user()->isApprovedEntrepreneur())
                                    <a href="{{ route('entrepreneur.dashboard') }}" class="flex items-center px-4 py-2 text-sm text-secondary-700 hover:bg-primary-50 hover:text-primary-600 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        Mon Espace
                                    </a>
                                @endif
                                
                                <div class="border-t border-secondary-100 my-2"></div>
                                
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-secondary-700 hover:bg-danger-50 hover:text-danger-600 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="open = !open" class="p-2 rounded-lg text-secondary-600 hover:text-primary-600 hover:bg-white/10 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="md:hidden border-t border-white/10 bg-white/95 backdrop-blur-md">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium text-secondary-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors duration-200">Accueil</a>
                    <a href="{{ route('stands.public.index') }}" class="block px-3 py-2 text-base font-medium text-secondary-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors duration-200">Exposants</a>
                    <a href="{{ route('cart.index') }}" class="block px-3 py-2 text-base font-medium {{ request()->routeIs('cart.*') ? 'text-primary-600 bg-primary-50' : 'text-secondary-700' }} hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors duration-200">Mon Panier</a>
                    
                    @guest
                        <div class="border-t border-secondary-200 pt-4 mt-4">
                            <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-secondary-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors duration-200">Connexion</a>
                            <a href="{{ route('register') }}" class="block px-3 py-2 text-base font-medium text-white bg-gradient-to-r from-primary-500 to-primary-600 rounded-lg mt-2">Devenir Exposant</a>
                        </div>
                    @else
                        <div class="border-t border-secondary-200 pt-4 mt-4">
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-base font-medium text-secondary-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors duration-200">Administration</a>
                            @elseif(auth()->user()->isApprovedEntrepreneur())
                                <a href="{{ route('entrepreneur.dashboard') }}" class="block px-3 py-2 text-base font-medium text-secondary-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors duration-200">Mon Espace</a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="block w-full text-left px-3 py-2 text-base font-medium text-danger-600 hover:bg-danger-50 rounded-lg transition-colors duration-200">Déconnexion</button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="fixed top-20 right-4 z-40 space-y-2" x-data="{ messages: [] }" x-init="
        @if(session('success'))
            messages.push({ type: 'success', text: '{{ session('success') }}', id: Date.now() });
            setTimeout(() => messages.shift(), 5000);
        @endif
        @if(session('error'))
            messages.push({ type: 'error', text: '{{ session('error') }}', id: Date.now() });
            setTimeout(() => messages.shift(), 5000);
        @endif
        @if(session('warning'))
            messages.push({ type: 'warning', text: '{{ session('warning') }}', id: Date.now() });
            setTimeout(() => messages.shift(), 5000);
        @endif
    ">
        <template x-for="message in messages" :key="message.id">
            <div x-show="true" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-x-full"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 translate-x-full"
                 class="max-w-sm w-full shadow-strong rounded-lg pointer-events-auto"
                 :class="{
                    'alert-success': message.type === 'success',
                    'alert-danger': message.type === 'error', 
                    'alert-warning': message.type === 'warning'
                 }">
                <div class="flex items-center justify-between p-4">
                    <span x-text="message.text"></span>
                    <button @click="messages = messages.filter(m => m.id !== message.id)" class="ml-4 text-current opacity-70 hover:opacity-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </template>
    </div>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-secondary-900 to-secondary-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo & Description -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 gradient-hero rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.1 13.34l2.83-2.83L3.91 3.5c-1.56 1.56-1.56 4.09 0 5.66l4.19 4.18zm6.78-1.81c1.53.71 3.68.21 5.27-1.38 1.91-1.91 2.28-4.65.81-6.12-1.46-1.46-4.20-1.10-6.12.81-1.59 1.59-2.09 3.74-1.38 5.27L3.7 19.87l1.41 1.41L12 14.41l6.88 6.88 1.41-1.41L13.41 13l1.47-1.47z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-display font-bold">Eat&Drink</span>
                    </div>
                    <p class="text-secondary-300 mb-4 max-w-md">
                        La plateforme culinaire incontournable qui rassemble les meilleurs chefs et producteurs locaux pour une expérience gastronomique unique.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-semibold mb-4">Navigation</h3>
                    <ul class="space-y-2 text-secondary-300">
                        <li><a href="{{ route('home') }}" class="hover:text-primary-400 transition-colors duration-200">Accueil</a></li>
                        <li><a href="{{ route('stands.public.index') }}" class="hover:text-primary-400 transition-colors duration-200">Exposants</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-primary-400 transition-colors duration-200">Devenir Exposant</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-secondary-300">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            contact@eatdrink.com
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            +229 01 91 48 60 08
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-secondary-700 mt-8 pt-8 text-center">
                <p class="text-secondary-400 text-sm">
                    &copy; {{ date('Y') }} Eat&Drink. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>

    <!-- Scroll to top button -->
    <button x-data="{ show: false }" 
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            @scroll.window="show = window.scrollY > 500"
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="fixed bottom-8 right-8 z-40 p-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-full shadow-strong hover:shadow-glow transition-all duration-300 hover:scale-110">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    <!-- Modal de confirmation -->
    <div x-data="{ 
        showModal: false, 
        modalTitle: '', 
        modalMessage: '', 
        confirmAction: null,
        confirmText: 'Confirmer',
        cancelText: 'Annuler',
        isInitialized: false,
        
        init() {
            this.isInitialized = true;
        },
        
        closeModal() {
            this.showModal = false;
            this.confirmAction = null;
            this.modalTitle = '';
            this.modalMessage = '';
        }
    }" 
    @confirm-modal.window="
        if (isInitialized) {
            showModal = true;
            modalTitle = $event.detail.title || 'Confirmation';
            modalMessage = $event.detail.message || 'Êtes-vous sûr ?';
            confirmAction = $event.detail.action;
            confirmText = $event.detail.confirmText || 'Confirmer';
            cancelText = $event.detail.cancelText || 'Annuler';
        }
    "
    @keydown.escape.window="if (showModal) closeModal()"
    style="display: none;"
    x-show="showModal">
        <!-- Overlay -->
        <div x-show="showModal && isInitialized" 
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
             @click="closeModal()">
            
            <!-- Modal -->
            <div x-show="showModal"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 @click.stop
                 class="bg-white rounded-xl shadow-strong max-w-md w-full">
                
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-secondary-900 mb-4" x-text="modalTitle"></h3>
                    <p class="text-secondary-600 mb-6" x-text="modalMessage"></p>
                    
                    <div class="flex space-x-3">
                        <button @click="closeModal()" 
                                class="btn btn-secondary flex-1" 
                                x-text="cancelText">
                        </button>
                        <button @click="if(confirmAction) confirmAction(); closeModal();" 
                                class="btn btn-danger flex-1" 
                                x-text="confirmText">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
