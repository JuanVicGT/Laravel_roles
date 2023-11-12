@props(['active'])

@php
    $classes = $active ?? false
        ? 'disabled flex items-center h-10 bg-transparent p-2 font-semibold hover:text-white border hover:border-transparent rounded'
        : 'flex items-center h-10 bg-transparent p-2 font-semibold hover:text-white border hover:border-transparent rounded';
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
