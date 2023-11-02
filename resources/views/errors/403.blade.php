<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        <div class="text-center">
            <a href="{{ route('dashboard') }}">
                <x-zondicon-lock-closed class="w-20 h-20" />
            </a>
            <h2 class="text-2xl">{{ __('403') }}</h2>
        </div>

        <div
            class="w-full sm:max-w-md mt-4 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg text-gray-900 dark:text-gray-100">
            <div class="row">
                <h3 class="text-center text-xl ">{{ __('Unauthorized') }}</h3>
            </div>
            <div class="row">
                <p>{{ __('desc-unauthorized') }}</p>
            </div>
            <div class="row text-right mt-4">
                <a href="{{ route('dashboard') }}">
                    <button
                        class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded inline-flex items-center">
                        <x-fas-home class="fill-current w-4 h-4 mr-2"/>
                        <span>{{ __('go-back-:attribute', ['attribute' => __('dashboard')]) }}</span>
                    </button>
                </a>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
