<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Eat&Drink') }} - @yield('title', 'Plateforme culinaire')</title>
    

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <a href="{{ route('home') }}" class="flex items-center">
                            <span class="text-2xl font-bold text-orange-600">Eat&Drink</span>
                        </a>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('home') ? 'text-orange-600 border-b-2 border-orange-600' : 'text-gray-500 hover:text-gray-700' }}">
                                Accueil
                            </a>
                            <a href="{{ route('stands.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('stands.*') ? 'text-orange-600 border-b-2 border-orange-600' : 'text-gray-500 hover:text-gray-700' }}">
                                Stands
                            </a>
                            <a href="{{ route('about') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('about') ? 'text-orange-600 border-b-2 border-orange-600' : 'text-gray-500 hover:text-gray-700' }}">
                                À propos
                            </a>
                        </div>
                    </div>

                    <!-- Right Side -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <!-- User Dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <span>{{ auth()->user()->name }}</span>
                                    <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                    @if(auth()->user()->hasRole('admin'))
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            🛠️ Administration
                                        </a>
                                    @endif
                                    
                                    @if(auth()->user()->hasRole('entrepreneur'))
                                        <a href="{{ route('entrepreneur.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            🏪 Mon espace
                                        </a>
                                    @endif

                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        👤 Profil
                                    </a>
                                    
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            🚪 Déconnexion
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700">Connexion</a>
                            <a href="{{ route('register') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                S'inscrire
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="sm:hidden" x-data="{ open: false }">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div x-show="open" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 text-base font-medium {{ request()->routeIs('home') ? 'text-orange-600 bg-orange-50' : 'text-gray-500' }}">
                            Accueil
                        </a>
                        <a href="{{ route('stands.index') }}" class="block pl-3 pr-4 py-2 text-base font-medium {{ request()->routeIs('stands.*') ? 'text-orange-600 bg-orange-50' : 'text-gray-500' }}">
                            Stands
                        </a>
                        <a href="{{ route('about') }}" class="block pl-3 pr-4 py-2 text-base font-medium {{ request()->routeIs('about') ? 'text-orange-600 bg-orange-50' : 'text-gray-500' }}">
                            À propos
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-4 mt-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-4 mt-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>