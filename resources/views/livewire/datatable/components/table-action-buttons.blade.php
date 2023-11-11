<div>
    <button
        class="flex items-center h-10 bg-transparent p-2 hover:bg-green-500 text-green-700 font-semibold hover:text-white border border-green-500 hover:border-transparent rounded"
        @click="expanded = !expanded">
        <x-fas-file-excel class="w-5 h-5" />
        {{ __('export') }}
    </button>
</div>
<div>
    <button
        class="flex items-center h-10 bg-transparent p-2 hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white border border-yellow-500 hover:border-transparent rounded"
        @click="expanded = !expanded">
        <x-fas-file-pdf class="w-5 h-5" />
        {{ __('print') }}
    </button>
</div>
<div>
    <button
        class="bg-transparent h-10 p-2 hover:bg-blue-500 text-blue-700 font-semibold hover:text-white border border-blue-500 hover:border-transparent rounded"
        @click="expanded = !expanded">
        <x-zondicon-filter class="w-5 h-5" />
    </button>
</div>
