@props(['tab_title'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $tab_title ?? config('app.name') }}</title>

    @if (file_exists(public_path('assets/images/favicon.ico')))
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire styles -->
    @livewireStyles
</head>

{{-- La variable notifications es para usar el componente de Penguin UI --}}

<body class="min-h-screen font-sans antialiased bg-base-200/50">
    <x-penguin-notification />

    @php
        $layout = auth()->user()->type_layout ?? $appSetting->get('general', 'type_layout', 'both');
        $layoutPath = resource_path('views/app/layouts/navigation/' . $layout . '.blade.php');
    @endphp

    @include('layouts.navigation.' . $layout)

    <!-- Livewire scripts -->
    @livewireScripts
</body>

</html>
