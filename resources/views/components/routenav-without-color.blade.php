@php
    $classes = 'flex h-10 items-center px-2 font-medium transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
