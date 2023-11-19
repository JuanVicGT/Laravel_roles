@props(['disabled' => false, 'custom_text'])

@php
    $classes = empty($custom_text) ? 'dark:text-gray-300' : $custom_text;
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm ' .
        $classes,
]) !!}>
