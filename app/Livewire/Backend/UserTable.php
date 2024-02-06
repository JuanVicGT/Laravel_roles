<?php

namespace App\Livewire\Backend;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class UserTable extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $sortBy = 'created_at';

    #[Url(history: true)]
    public $sortDir = 'DESC';

    public $perPage = 7;

    // Filters
    public $search = '';
    public $filter_start_date = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function delete(User $user)
    {
        $this->authorize('delete', Auth::user());

        $user->delete();
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
        $users = User::when(
            $this->search,

            fn ($query) =>
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
        )->when(
            $this->filter_start_date,

            fn ($query) =>
            $query->where('updated_at', '>', "{$this->filter_start_date}")
        )
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.backend.user_table', ['users' => $users]);
    }
}
