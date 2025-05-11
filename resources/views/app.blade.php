<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css'])
    <!-- Styles -->
    @livewireStyles
    <!-- Scripts -->
</head>
<body>
    {{-- If you need unique page class name - add route name in your route file --}}
    <div id="app" class="{{ request()->route()->getName() }}"> {{-- DONT CHANGE ELEMENT id --}}
        <header class="bg-light py-3 border-bottom">
            <div class="container d-flex justify-content-between align-items-center">
                <a href="{{ url('/') }}" class="text-decoration-none fs-4 fw-bold text-dark">Test Shop</a>
                <a href="/cart/" class="btn btn-outline-primary">Cart</a>
            </div>
        </header>
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
        <footer>
            <div class="container py-4">
                {{-- Footer Code --}}
            </div>
        </footer>
    </div>
    @livewireScripts
    @vite(['resources/js/app.js'])
</body>
</html>
