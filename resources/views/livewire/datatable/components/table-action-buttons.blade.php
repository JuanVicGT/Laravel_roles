    <x-hover-button class="hover:bg-gray-500 text-gray-700 dark:text-gray-300 border-gray-500" wire:click="$refresh">
        <x-fas-search class="w-5 h-5" />
    </x-hover-button>

    <x-hover-button class="hover:bg-blue-500 text-blue-700 dark:text-blue-500 border-blue-500" @click="expanded = !expanded">
        <x-zondicon-filter class="w-5 h-5" />
    </x-hover-button>

    <x-hover-button class="hover:bg-green-500 text-green-700 dark:text-green-500 border-green-500">
        <x-fas-file-excel class="w-5 h-5" />
        {{ __('export') }}
    </x-hover-button>

    <x-hover-button class="hover:bg-yellow-500 text-yellow-700 dark:text-yellow-500 border-yellow-500">
        <x-fas-file-pdf class="w-5 h-5" />
        {{ __('print') }}
    </x-hover-button>
