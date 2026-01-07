<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Panganku') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200 px-4 py-4">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between">
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-green-600">Panganku</a>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex ml-10 space-x-8">
                    <a href="{{ route('donations.index') }}" class="text-gray-700 hover:text-green-600 font-medium">{{ __('nav.donations') }}</a>
                    <a href="{{ route('requests.index') }}" class="text-gray-700 hover:text-green-600 font-medium">{{ __('nav.requests') }}</a>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-green-600 font-medium">{{ __('nav.categories') }}</a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right: Greeting + Logout -->
            <div class="flex items-center space-x-6">
                @auth
                    <span class="text-gray-600">Halo, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Keluar</button>
                    </form>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                    class="text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden mt-4 space-y-2">
            <a href="{{ route('donations.index') }}" class="block text-gray-700 hover:text-green-600 py-2">{{ __('nav.donations') }}</a>
            <a href="{{ route('requests.index') }}" class="block text-gray-700 hover:text-green-600 py-2">{{ __('nav.requests') }}</a>
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('categories.index') }}" class="block text-gray-700 hover:text-green-600 py-2">{{ __('nav.categories') }}</a>
                @endif
            @endauth
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error') || $errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
                @if($errors->any())
                    <ul class="list-disc pl-5 mt-2">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                @endif
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-auto bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <p class="text-center text-gray-500 text-sm">
            © {{ date('Y') }} Panganku. All rights reserved.
        </p>
    </div>
    </footer>
</body>
</html>
