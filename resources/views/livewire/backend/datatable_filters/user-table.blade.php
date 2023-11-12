<div class="flex flex-wrap space-y-2">
    <!-- Name -->
    <div class="w-full md:w-1/2 px-2">
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus
            autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <!-- Name -->
    <div class="w-full md:w-1/2 px-2">
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" />
    </div>
</div>

<!-- Start date -->
<div class="flex flex-wrap space-y-2 mt-2">
    <!-- Date -->
    <div class="w-full md:w-1/2 px-2">
        <x-input-label for="start_date" :value="__('Date')" />
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <x-fas-calendar-alt class="w-4 h-4 dark:text-gray-300" />
            </div>
            <x-text-input id="start_date" class="block mt-1 w-full ps-10" type="date" name="start_date"
                wire:model="filter_start_date" />
        </div>
    </div>
</div>
