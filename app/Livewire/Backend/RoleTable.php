<?php

namespace App\Livewire\Backend;

use App\Models\Role;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RoleTable extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $sortBy = 'name';

    #[Url(history: true)]
    public $sortDir = 'DESC';

    public $perPage = 7;

    // Filters
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function delete(Role $role)
    {
        $this->authorize('delete', Auth::user());

        $role->delete();
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function render(): mixed
    {
        $roles = Role::when(
            $this->search,

            fn ($query) =>
            $query->where('name', 'like', "%{$this->search}%")
        )
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.backend.role-table', ['roles' => $roles]);
    }
}
