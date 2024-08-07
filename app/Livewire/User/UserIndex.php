<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserIndex extends Component
{
    public $users;
    public $user, $id, $email, $name, $password;
    public $formTambah = 0;
    public function tambah()
    {
        $this->formTambah = $this->formTambah ? 0 : 1;
        $this->reset(['user', 'id', 'email', 'name', 'password']);
    }
    public function edit($id)
    {
        $user = User::find($id);
        $this->user =  $user;
        $this->formTambah = 1;
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }
    public function simpan()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->id,
        ]);
        try {
            if ($this->id) {
                $user = User::find($this->id);
                $user->update([
                    'name' => $this->name,
                    'email' => $this->email,
                ]);
            } else {
                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => bcrypt($this->password)
                ]);
            }
            $this->formTambah = 0;
            flash('User berhasil disimpan', 'success');
        } catch (\Throwable $th) {
            flash($th->getMessage(), 'success');
        }
    }
    public function render()
    {
        $this->users = User::get();
        return view('livewire.user.user-index')->title('User Management');
    }
}
