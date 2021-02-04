<?php

namespace App\Http\Livewire\Admin\Roles;

use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdateRole extends Component
{
    public $roleId;
    public $name;
    public $permissions;

    public function render()
    {
        return view('livewire.admin.roles.update-role');
    }

    /**
     * Update an edited role in storage.
     */
    public function update()
    {
        $this->validate([
            'name'        => ['required', 'string', 'min:4', 'max:255', Rule::unique('roles')->ignore($this->roleId)],
            'permissions' => 'required|array',
        ]);
        $this->updateRole();
        Session::flash('roleUpdated', 'The "' . $this->name . '" role updated.');
    }

    /**
     * Update the role and assign its permissions.
     */
    protected function updateRole()
    {
        $role = Role::find($this->roleId);
        $role->permissions()->detach();
        $role->update(['name' => $this->name]);
        foreach ($this->permissions as $permission) {
            Permission::findOrCreate($permission)->assignRole($role);
        }
    }
}