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
    protected $listeners = [
        'refreshRolesIndex' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.admin.roles.roles-index', [
            'roles' => Role::with('permissions')->orderBy('created_at', 'desc')->paginate($this->perPage),
        ]);
    }

    /**
     * Remove the specified role from storage.
     *
     * @param $roleId
     * @return void
     */
    public function deleteRole($roleId)
    {
        Role::find($roleId)->delete();
    }
}
