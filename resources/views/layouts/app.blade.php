<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 md:overflow-auto dark:bg-gray-900" x-data="{ open_nav: false, scrolledFromTop: false }"
    class="{
        'overflow-hidden': open_nav,
        'overflow-auto': !open_nav
    }">
    <!-- Page Heading -->
    <header class="fixed w-full z-30 h-fit flex border-b border-gray-100 dark:border-gray-700"
        :class="{ 'h-24': !scrolledFromTop, 'h-14': scrolledFromTop }">
        @include('layouts.navigation')
    </header>

    <!-- Page Content -->
    <main class="pt-8">
        {{ $slot }}
    </main>

    <!-- Page Footer -->
    <footer class="bg-white dark:bg-gray-800 shadow sticky bottom-0">
        @include('body.footer')
    </footer>
    
    <!-- Avoid double injection of scripts -->
    @livewireScriptConfig 
</body>

</html>
