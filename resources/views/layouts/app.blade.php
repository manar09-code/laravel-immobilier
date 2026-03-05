<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ImmoBnB') }} - @yield('title', 'Accueil')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">

    <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('properties.index') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-primary">Immo<span class="text-secondary">BnB</span></span>
                </a>

                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('properties.index') }}"
                       class="text-gray-600 hover:text-primary font-medium transition-colors">
                        Propriétés
                    </a>
                    @auth
                    <a href="{{ route('bookings.index') }}"
                       class="text-gray-600 hover:text-primary font-medium transition-colors">
                        Mes réservations
                    </a>
                    @endauth
                </div>

                <div class="flex items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary font-medium transition-colors">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}"
                           class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-800 font-medium transition-colors">
                            S'inscrire
                        </a>
                    @else
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-600">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors text-sm">
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-100 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <span class="font-bold text-primary">Immo<span class="text-secondary">BnB</span></span>
                <p class="text-sm text-gray-500">&copy; {{ date('Y') }} ImmoBnB. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>