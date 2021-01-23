<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public $perPage = 10;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.users.users-index', [
            'users' => User::orderBy('created_at', 'desc')->paginate($this->perPage),
        ]);
    }

    public function updatedperPage()
    {
        $this->resetPage();
    }
}
