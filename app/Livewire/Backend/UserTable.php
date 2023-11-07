<?php

namespace App\Livewire\Backend;

use App\Livewire\Datatable\Main as BaseTable;
use App\Models\User;

class UserTable extends BaseTable
{
    public function render(): mixed
    {
        $users = User::where(
            fn ($query) =>
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
        )
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.datatable.main', ['users' => $users]);
    }
}
