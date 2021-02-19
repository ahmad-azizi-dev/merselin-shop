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
        $this->validate($this->getRules());
        if (auth()->user()->can('update roles')) {
            $this->updateRole();
            Session::flash('roleUpdated', 'The "' . $this->name . '" role updated.');
        } else {
            Session::flash('accessDenied', 'no permission to edit role.');
        }
    }

    /**
     * Update the role and assign its permissions.
     */
    protected function updateRole()
    {
        $role = Role::find($this->roleId);
        $role->permissions()->detach();
        if ($role->name !== 'super-admin') {
            $role->update(['name' => $this->name]);
        }
        foreach ($this->permissions as $permission) {
            Permission::findOrCreate($permission)->assignRole($role);
        }
    }

    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [
            'name'        => ['required', 'string', 'min:4', 'max:255', Rule::unique('roles')->ignore($this->roleId)],
            'permissions' => 'nullable|array',
        ];
    }
}
