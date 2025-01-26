<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@php
    $appService = app(App\Services\AppSettingService::class);
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('tab-title', config('app.layout_name', __('New Instance')))</title>

    @if (file_exists(public_path('assets/images/favicon.ico')))
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire styles -->
    @livewireStyles
</head>

{{-- La variable notifications es para usar el componente de Penguin UI --}}

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200" x-data>
<x-penguin-notification/>

@php
    $layout = auth()->user()->type_layout ?? $appService->get('general', 'type_layout', 'both');
    $layoutPath = resource_path('views/layouts/themes/' . $layout . '.blade.php');
@endphp

@if (file_exists($layoutPath))
    @include('layouts.themes.' . $layout)
@else
    @include('layouts.themes.' . 'default')
@endif

{{-- Theme toggle --}}
<x-mary-theme-toggle class="hidden"/>

<!-- Livewire scripts -->
@livewireScripts
</body>

</html>
