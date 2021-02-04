<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolesIndex extends Component
{
    use WithPagination;

    public $perPage = 10;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.roles.roles-index', [
            'roles' => Role::orderBy('created_at', 'desc')->paginate($this->perPage),
        ]);
    }

    public function updatedperPage()
    {
        $this->resetPage();
    }
}
