<x-slot name="trigger">
    <x-zondicon-lock-closed class="w-4 h-4 mr-2" />
    <div class="flex items-center w-full justify-between">
        <p class="text-base">Hola</p>
        <x-zondicon-cheveron-right class="w-4 h-4" />
    </div>
</x-slot>

<x-slot name="content">

    <x-dropdown-link :href="route('profile.edit')">
        <div class="flex items-center">
            <x-zondicon-lock-closed class="w-4 h-4 mr-2" />
            <div class="flex items-center w-full justify-between">
                <p class="text-basetext-base">Hola</p>
            </div>
        </div>
    </x-dropdown-link>

</x-slot>
