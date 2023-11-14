<div class="flex flex-wrap">
    <!-- Start date -->
    <div class="w-full">
        <x-input-label for="start_date" :value="__('Last Update')" />
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <x-fas-calendar-alt class="w-4 h-4 dark:text-gray-300" />
            </div>
            <x-text-input id="start_date" class="block mt-1 w-full ps-10" type="date" name="start_date"
                wire:model="filter_start_date" />
        </div>
    </div>
</div>
