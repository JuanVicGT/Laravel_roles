<?php

namespace App\Livewire\Modules\SimpleFinancialManagement;

use Livewire\Component;

use Modules\SimpleFinancialManagement\Models\Wallet;
use Modules\SimpleFinancialManagement\Models\Movement;
use Modules\SimpleFinancialManagement\Models\Addressee;

use Livewire\WithPagination;

class MovementCrud extends Component
{
    use WithPagination;

    public $per_page;
    public $search;
    public $sortBy;
    public $sortAsc;

    public $wallets = [];
    public $destinations = [];

    public $total_income = 0;
    public $total_expense = 0;
    public $total_balance = 0;

    public $new_movement_name = '';
    public $new_movement_wallet = '';
    public $new_movement_type = '';
    public $new_movement_destination = '';
    public $new_movement_amount = '';
    public $new_movement_date = '';

    public $movements_types;

    // Para mostrar/ocultar modales
    public $add_wallet_modal = false;
    public $add_destination_modal = false;

    // Variables de modales
    public $new_wallet_name = '';
    public $new_wallet_reason = '';
    public $new_destination_name = '';

    // Variables para la tabla de movimientos
    public $headers;

    public function mount()
    {
        $this->per_page = 10;
        $this->search = '';
        $this->sortBy = 'id';
        $this->sortAsc = true;

        $this->movements_types = [
            ['id' => 'expense', 'name' => __('Expense')],
            ['id' => 'income', 'name' => __('Income')],
        ];

        // Variables para la tabla
        $this->headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'description', 'label' => __('Name')],
            ['key' => 'date', 'label' => __('Date')],
            ['key' => 'wallet.name', 'label' => __('Wallet')],
            ['key' => 'addressee.nombre', 'label' => __('Destination')],
            ['key' => 'income', 'label' => __('Income')],
            ['key' => 'expense', 'label' => __('Expense')]
        ];
    }

    public function render()
    {
        $this->wallets = Wallet::all();
        $this->destinations = Addressee::all();

        $this->new_movement_type = $this->movements_types[0]['id'];
        $this->new_movement_date = date('Y-m-d');

        $this->new_movement_wallet = $this->wallets[0]['id'] ?? null;
        $this->new_movement_destination = $this->destinations[0]['id'] ?? null;

        $this->loadTotals();
        $movements = $this->queryMovements();
        return view('livewire.modules.simple-financial-management.movement-crud', [
            'movements' => $movements
        ]);
    }

    #region Acciones

    /**
     * Obtiene los movimientos
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function queryMovements(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Movement::where('description', 'LIKE', '%' . $this->search . '%')
            ->with(['wallet', 'addressee'])
            ->orderBy($this->sortBy, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->per_page);
    }

    protected function loadTotals(): void
    {
        $totals = Movement::getTotals();

        $this->total_income = $totals['total_income'];
        $this->total_expense = $totals['total_expense'];
        $this->total_balance = $totals['total_balance'];
    }

    public function showAddWalletModal(): void
    {
        $this->add_wallet_modal = true;
    }

    public function addWallet(): void
    {
        $this->validate([
            'new_wallet_name' => 'required',
            'new_wallet_reason' => 'required',
        ]);

        $walletCreated = Wallet::create([
            'name' => $this->new_wallet_name,
            'reason' => $this->new_wallet_reason,
        ]);

        if (!$walletCreated) {
            $this->dispatch('notify', variant: 'error', message: __('Wallet not created'));
            $this->add_wallet_modal = false;
            return;
        }

        $this->new_wallet_name = '';
        $this->new_wallet_reason = '';

        $this->dispatch('notify', variant: 'success', message: __('Wallet created'));

        $this->wallets = Wallet::all();
        $this->add_wallet_modal = false;
    }

    public function showAddDestinationModal(): void
    {
        $this->add_destination_modal = true;
    }

    public function addDestination(): void
    {
        $addresseeCreated = Addressee::create([
            'nombre' => $this->new_destination_name,
        ]);

        $this->new_destination_name = '';

        if (!$addresseeCreated) {
            $this->dispatch('notify', variant: 'error', message: __('Addressee not created'));
            $this->add_destination_modal = false;
            return;
        }

        $this->destinations = Addressee::all();
        $this->dispatch('notify', variant: 'success', message: __('Addressee created'));
        $this->add_destination_modal = false;
    }

    public function addMovement(): void
    {
        $this->validate([
            'new_movement_name' => 'required',
            'new_movement_wallet' => 'required',
            'new_movement_destination' => 'required',
            'new_movement_amount' => 'required',
            'new_movement_date' => 'required',
            'new_movement_type' => 'required',
        ]);

        $income = ($this->new_movement_type == 'income') ? $this->new_movement_amount : 0;
        $expense = ($this->new_movement_type == 'expense') ? $this->new_movement_amount : 0;

        $movementAdded = Movement::create([
            'description' => $this->new_movement_name,
            'wallet_id' => $this->new_movement_wallet,
            'addressee_id' => $this->new_movement_destination,
            'income' => $income,
            'expense' => $expense,
            'date' => $this->new_movement_date,
            'type' => $this->new_movement_type,
        ]);

        if (!$movementAdded) {
            $this->dispatch('notify', variant: 'error', message: __('Movement not created'));
            return;
        }

        $this->dispatch('notify', variant: 'success', message: __('Movement created'));
        $this->clearMainForm();
    }

    public function deleteMovement(): void {}

    public function editMovement(): void {}

    public function updateMovement(): void {}

    public function clearMainForm(): void
    {
        $this->new_movement_name = '';
        $this->new_movement_wallet = '';
        $this->new_movement_destination = '';
        $this->new_movement_amount = '';
        $this->new_movement_date = date('Y-m-d');
        $this->new_movement_type = $this->movements_types[0]['id'];

        $this->dispatch('focus', ['new_movement_name']);
    }
    #endregion Acciones
}
