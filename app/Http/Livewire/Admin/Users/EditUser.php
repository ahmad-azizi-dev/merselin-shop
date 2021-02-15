<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditUser extends Component
{
    public $userId;
    public $phone_number;
    public $name;
    public $email;
    public $password;
    public $roles;
    public $allRoles;

    public function render()
    {
        return view('livewire.admin.users.edit-user');
    }

    /**
     * Update an edited role.
     */
    public function update()
    {
        $this->validate($this->getRules());
        $this->updateUser();
        Session::flash('userUpdated', 'The user updated.');
    }

    /**
     * Update the role and assign its permissions.
     */
    protected function updateUser()
    {
        $user = User::find($this->userId);
        $user->update($this->allInputs());
        $user->syncRoles($this->roles);
    }

    /**
     * Get all the validation rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return [
            'phone_number' => ['nullable', 'numeric', 'min:9000000000', 'max:9999999999', Rule::unique('users')->ignore($this->userId)],
            'name'         => 'nullable|string|min:4|max:255',
            'email'        => ['nullable', 'string', 'email', 'min:4', 'max:255', Rule::unique('users')->ignore($this->userId)],
            'roles'        => 'nullable|array',
            'password'     => 'nullable|string|min:6|max:255',
        ];
    }

    /**
     * Return an array of needed inputs.
     *
     * @return array
     */
    protected function allInputs(): array
    {
        return array_merge([
            'name'  => $this->name ?? 'not_set',
            'email' => $this->email ?? 'not_set-' . Str::random(20),
        ],
            $this->phone_number ? ['phone_number' => $this->phone_number] : ['phone_number' => 9999999999 + mt_rand()],
            $this->password === null ? [] : ['password' => Hash::make($this->password)]);
    }

}
