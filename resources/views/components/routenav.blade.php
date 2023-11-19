@php
    $classes = 'flex h-10 items-center dark:text-white text-gray-700 bg-white dark:bg-gray-500 px-2 font-medium transition hover:bg-gray-500 dark:hover:bg-gray-700 hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
