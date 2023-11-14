<x-modal name="confirm-{{ $model }}-deletion-{{ $id }}" focusable>
    <div class="p-6">
        <section>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __($title) }}
            </h2>
        </section>

        <section>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __($description) }}
            </p>
        </section>

        <section>
            <div class="mt-6 flex justify-between">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3" wire:click="delete({{ $id }})">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </section>
    </div>
</x-modal>
