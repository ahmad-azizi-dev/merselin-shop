<?php

namespace App\Http\Livewire\Admin\Roles;

use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRole extends Component
{
    public $name;
    public $permissions;

    protected $rules = [
        'name'        => 'required|string|min:4|max:255|unique:roles,name,',
        'permissions' => 'nullable|array',
    ];

    public function render()
    {
        return view('livewire.admin.roles.create-role');
    }

    /**
     * Store a newly created role in storage.
     */
    public function store()
    {
        $this->validate();
        if (auth()->user()->can('create roles')) {
            $this->createRole();
            $this->resetAllData();
            $this->emit('refreshRolesIndex');
        } else {
            Session::flash('accessDenied', 'no permission to create a role.');
        }
    }

    /**
     * Create a role and assign its permissions.
     */
    protected function createRole()
    {
        $role = Role::create(['name' => $this->name]);
        foreach ($this->permissions ?? [] as $permission) {
            Permission::findOrCreate($permission)->assignRole($role);
        }
        Session::flash('roleAdded', 'The "' . $this->name . '" role added.');
    }

    /**
     * Reset all data.
     */
    protected function resetAllData(): void
    {
        $this->name = null;
        $this->permissions = null;
    }
}
