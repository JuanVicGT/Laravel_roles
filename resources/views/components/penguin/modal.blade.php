@props(['id', 'title' => null])

<div x-cloak x-data="{ modalIsOpen: false }" @open-modal.window="if ($event.detail === '{{ $id }}') modalIsOpen = true"
    @close-modal.window="if ($event.detail === '{{ $id }}') modalIsOpen = false">

    <!-- Modal Overlay -->
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
        x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
        class="fixed inset-0 z-30 flex items-center justify-center bg-gray-800/75 p-4 pb-8 backdrop-blur-md sm:justify-start sm:items-start lg:justify-center lg:items-center"
        role="dialog" aria-modal="true" aria-labelledby="{{ $id }}Title">

        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
            x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
            x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex max-w-full min-w-lg flex-col gap-4 overflow-hidden rounded-lg border border-gray-700 bg-white text-black dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100">

            <!-- Dialog Header -->
            <div
                class="flex items-center justify-between border-b border-gray-200 bg-gray-100 p-4 dark:border-gray-700 dark:bg-gray-800">
                @if ($title)
                    <h3 id="{{ $id }}Title" class="font-semibold tracking-wide text-black dark:text-white">
                        {{ $title }}
                    </h3>
                @endif
                <button x-on:click="modalIsOpen = false" aria-label="Close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                        fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Dialog Body -->
            <div class="px-4 pt-4 pb-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
