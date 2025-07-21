@extends('layouts.app')

@section('content')
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-orange-400">Eat&Drink</h2>
                <p class="text-sm text-gray-300">Administration</p>
            </div>
            
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                    <span class="mr-3">📊</span>
                    Tableau de bord
                </a>
                
                <a href="{{ route('admin.users.pending') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.users.pending') ? 'bg-gray-700 text-white' : '' }}">
                    <span class="mr-3">⏳</span>
                    Demandes en attente
                    @if($pendingCount = \App\Models\User::where('status', 'pending')->count())
                        <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $pendingCount }}</span>
                    @endif
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.users.index') ? 'bg-gray-700 text-white' : '' }}">
                    <span class="mr-3">👥</span>
                    Utilisateurs
                </a>
                
                <div class="border-t border-gray-700 mt-6 pt-6">
                    <a href="{{ route('home') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                        <span class="mr-3">🏠</span>
                        Voir le site
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <span class="mr-3">🚪</span>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-semibold text-gray-900">
                            @yield('title', 'Administration')
                        </h1>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">Connecté en tant que</span>
                            <span class="font-medium text-gray-900">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-md shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-md shadow-lg z-50">
            {{ session('error') }}
        </div>
    @endif
@endsection