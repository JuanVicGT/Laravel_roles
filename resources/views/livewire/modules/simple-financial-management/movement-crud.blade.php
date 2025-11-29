<div class="py-2">
    {{-- Opciones para ingresar nuevas "wallets" y "destinatarios" --}}
    <x-mary-card>
        <div>
            <x-mary-collapse separator>
                <x-slot:heading>
                    {{ __('Others') }}
                </x-slot:heading>
                <x-slot:content class="flex justify-center gap-2">
                    <x-mary-button class="btn-primary" label="{{ __('Add Wallet') }}" wire:click="showAddWalletModal"
                        icon="o-wallet" spinner />
                    <x-mary-button class="btn-primary" label="{{ __('Add Destination') }}"
                        wire:click="showAddDestinationModal" icon="o-user" />
                </x-slot:content>
            </x-mary-collapse>
        </div>
    </x-mary-card>

    {{-- Formulario para ingresar nuevos movimientos --}}
    <x-mary-card class="mt-4">
        <x-mary-form wire:submit="addMovement">
            <div class="grid grid-cols-3 gap-4">
                <x-mary-input label="{{ __('Name') }}" wire:model="new_movement_name" autofocus />

                <x-mary-input label="{{ __('Amount') }}" wire:model="new_movement_amount" prefix="Q" type="number"
                    hint="{{ __('Amount Income/Expense') }}" step="0.01" min="0" />

                <x-mary-datetime label="{{ __('Date') }}" wire:model="new_movement_date" />

                <x-mary-radio label="{{ __('Type') }}" wire:model="new_movement_type" :options="$movements_types" inline />

                <x-mary-select label="{{ __('Wallet') }}" wire:model="new_movement_wallet" :options="$wallets" />

                <x-mary-select label="{{ __('Destination') }}" wire:model="new_movement_destination" :options="$destinations"
                    option-label="nombre" />
            </div>

            <x-slot:actions>
                <x-mary-button label="{{ __('Clear') }}" class="btn-error text-white" wire:click="clearMainForm"
                    spinner />
                <x-mary-button label="{{ __('Save') }}" class="btn-success" type="submit" spinner="save"
                    icon="s-folder-plus" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-card>

    {{-- Tabla de movimientos realizados --}}
    <x-mary-card class="mt-4">
        {{-- Tabla de movimientos realizados --}}
        <x-mary-table :headers="$headers" :rows="$movements">
            @scope('cell_income', $mov)
                @if ($mov['income'] > 0)
                    <strong class="text-success">Q
                        {{ number_format($mov['income'], 2) }}</strong>
                @endif
            @endscope

            @scope('cell_expense', $mov)
                @if ($mov['expense'] > 0)
                    <strong class="text-error">Q
                        {{ number_format($mov['expense'], 2) }}</strong>
                @endif
            @endscope

            <x-slot:footer>
                <tr>
                    <td colspan="4"></td>
                    <td class="text-center">
                        {{ __('Totals') }}
                    </td>
                    <td class="text-center">Q {{ number_format($total_income, 2) }}</td>
                    <td class="text-center">Q {{ number_format($total_expense, 2) }}</td>
                </tr>

                <tr>
                    <td colspan="4"></td>
                    <td class="text-center">
                        {{ __('Balance') }}
                    </td>
                    <td class="text-center" colspan="2">
                        @if ($total_balance > 0)
                            <strong class="text-success">Q {{ number_format($total_balance, 2) }}</strong>
                        @else
                            <strong class="text-error">Q {{ number_format($total_balance, 2) }}</strong>
                        @endif
                    </td>
                </tr>

                <tr>
                    <x-mary-pagination :rows="$movements" wire:model.live="per_page" />
                </tr>
            </x-slot:footer>
        </x-mary-table>
    </x-mary-card>

    {{-- Model to add destinations --}}
    <x-mary-modal wire:model="add_destination_modal" title="{{ __('Add Destination') }}">
        <x-mary-form no-separator>
            <x-mary-input label="{{ __('Name') }}" icon="o-user" wire:model="new_destination_name"
                placeholder="{{ __('Name of a destination') }}" />

            {{-- Notice we are using now the `actions` slot from `x-form`, not from modal --}}
            <x-slot:actions>
                <x-mary-button label="Cancel" @click="$wire.add_destination_modal = false" />
                <x-mary-button label="Confirm" class="btn-primary" wire:click="addDestination" spinner />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>

    {{-- Models to add wallets --}}
    <x-mary-modal wire:model="add_wallet_modal" title="{{ __('Add Wallet') }}">
        <x-mary-form no-separator class="gap-4">
            <x-mary-input label="{{ __('Name') }}" icon="o-wallet" wire:model="new_wallet_name" />

            <x-mary-input label="{{ __('Reason') }}" wire:model="new_wallet_reason" />

            {{-- Notice we are using now the `actions` slot from `x-form`, not from modal --}}
            <x-slot:actions>
                <x-mary-button label="Cancel" @click="$wire.add_wallet_modal = false" />
                <x-mary-button label="Confirm" class="btn-primary" wire:click="addWallet" spinner />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
</div>
