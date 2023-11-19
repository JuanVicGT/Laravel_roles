@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center p-2 bg-blue-500 text-white rounded-lg hover:bg-gray-700 dark:hover:bg-gray-700 group'
            : 'flex items-center p-2 bg-white dark:text-white dark:bg-gray-500 hover:text-white rounded-lg hover:bg-gray-500 dark:hover:bg-gray-700 group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>