<div x-data="{ expanded: false }">
    <button
        class="bg-transparent p-2 hover:bg-blue-500 text-blue-700 font-semibold hover:text-white border border-blue-500 hover:border-transparent rounded"
        @click="expanded = !expanded">
        <x-zondicon-filter class="w-5 h-5" />
    </button>

    <div x-data="{ ghost: false }" x-show="expanded"
        x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="max-w-sm w-full pointer-events-auto">
        <p>lorem ispm</p>
    </div>
</div>
