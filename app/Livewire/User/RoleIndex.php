<?php

namespace App\Livewire\User;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleIndex extends Component
{
    public $roles, $role, $id, $name, $permissions;
    public $selectedPermissions = [];
    public $form = 0;
    public function tambah()
    {
        $this->form = 1;
        $this->reset(['role', 'id', 'name', 'permissions']);
    }
    public function batal()
    {
        $this->form = 0;
    }
    public function simpan()
    {
        $this->validate([
            'name' => 'required',
        ]);
        $role = Role::updateOrCreate(
            ['id' => $this->id],
            ['name' => $this->name],
        );
        $role->syncPermissions();
        $role->syncPermissions($this->selectedPermissions);
        flash('Role ' . $role->name . ' saved successfully.', 'success');
        $this->form = 0;
    }
    public function edit(Role $role)
    {
        $this->role = $role;
        $this->id = $role->id;
        $this->name = $role->name;
        $this->permissions = Permission::pluck('name', 'id');
        $this->selectedPermissions = $role->permissions()->pluck('name');
        $this->form = 1;
    }
    public function render()
    {
        $this->roles = Role::get();
        $this->permissions = Permission::pluck('name', 'id');
        return view('livewire.user.role-index');
    }
}
