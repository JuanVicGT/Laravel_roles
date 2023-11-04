@props(['active', 'align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white dark:bg-gray-700'])

@php
    $classes = $active ?? false ? 'flex items-center pl-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out' : 'inline-flex items-center pl-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';

    switch ($align) {
        case 'left':
            $alignmentClasses = 'origin-top-left left-0';
            break;
        case 'top':
            $alignmentClasses = 'origin-top';
            break;
        case 'right':
        default:
            $alignmentClasses = 'origin-top-right right-0';
            break;
    }

    switch ($width) {
        case '48':
            $width = 'w-48';
            break;
    }
@endphp

<div {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out']) }}
    x-data="{ submenu: false }" @click="submenu = ! submenu" @click.outside="submenu = false" @close.stop="submenu = false">
    <div class="flex items-center">
        {{ $trigger }}

        <div class="rounded-md max-w-[180px] w-full h-min max-h-screen top-0 absolute -right-[185px] bg-white dark:bg-gray-700"
            x-show="submenu" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95">

            {{ $content }}
        </div>
    </div>
</div>
