<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class PermissionIndex extends Component
{
    public $formPermission = 0;
    public $permissions, $permission, $id, $name;
    public function tambahPermission()
    {
        $this->formPermission = 1;
        $this->reset(['permission', 'id', 'name']);
    }
    public function batal()
    {
        $this->formPermission = 0;
    }
    public function edit(Permission $permission)
    {
        $this->id = $permission->id;
        $this->name = $permission->name;
        $this->formPermission = 1;
    }
    public function simpanPermission()
    {
        $this->validate([
            'name' => 'required',
        ]);
        $permission = Permission::updateOrCreate(
            ['id' => $this->id],
            ['name' => Str::slug($this->name)],
        );
        $this->formPermission = 0;
        flash('Permission ' . $permission->name . ' saved successfully.', 'success');
    }
    public function render()
    {
        $this->permissions = Permission::get();
        return view('livewire.user.permission-index');
    }
}
