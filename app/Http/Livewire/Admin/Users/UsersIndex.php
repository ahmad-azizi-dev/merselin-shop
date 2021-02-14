<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UsersIndex extends Component
{
    use WithPagination;

    public $perPage = 10;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refreshUsersIndex' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.admin.users.users-index', [
            'users'    => User::with('roles')->orderBy('created_at', 'desc')->paginate($this->perPage),
            'allRoles' => Role::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function updatedperPage()
    {
        $this->resetPage();
    }
}
