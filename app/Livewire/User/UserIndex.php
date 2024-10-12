<?php

namespace App\Livewire\User;

use App\Exports\UserExport;
use App\Imports\UserImport;
use App\Models\ActivityLog;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class UserIndex extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $formUser = 0;
    public $roles = [];
    public $userId, $name, $username, $phone, $email, $role, $password;
    public $formImport = 0;
    public $fileImport;

    public function sort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortBy = $field;
    }

    public function tambah()
    {
        $this->reset(['userId', 'name', 'username', 'phone', 'email', 'role', 'password']);
        $this->formUser = 1;
    }

    public function batal()
    {
        $this->formUser = 0;
    }

    public function edit($id)
    {
        $user = User::find($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->role = $user->roles->first()->name ?? null;
        $this->formUser = 1;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|min:3',
            'username' => 'required|string|min:3',
            'phone' => 'required|numeric|min:9',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        $data = [
            'name' => $this->name,
            'username' => $this->username,
            'phone' => $this->phone,
            'email' => $this->email,
            'pic' => auth()->user()->name,
        ];

        if (!empty($this->password)) {
            $data['password'] = bcrypt($this->password);
        }

        $user = User::updateOrCreate(
            ['id' => $this->userId],
            $data
        );

        $user->syncRoles($this->role);

        ActivityLog::createLog(
            'Update/Create User',
            auth()->user()->name . ' menyimpan user ' . $user->name
        );

        Alert::success('Success', 'User ' . $user->name . ' saved successfully');

        return redirect()->route('user.index');
    }

    public function verifikasi($id)
    {
        $user = User::find($id);
        $user->email_verified_at = $user->email_verified_at ? null : now();
        $user->pic = auth()->user()->name;
        $user->user_verify = auth()->user()->name;
        $user->save();

        $status = $user->email_verified_at ? 'memverifikasi' : 'membatalkan verifikasi';

        ActivityLog::createLog(
            'Verify User',
            auth()->user()->name . " $status user " . $user->name
        );

        Alert::success('Success', 'User ' . $user->name . ' verification status changed successfully');

        return redirect()->route('user.index');
    }

    public function hapus($id)
    {
        $user = User::find($id);
        $user->delete();

        ActivityLog::createLog(
            'Delete User',
            auth()->user()->name . ' menghapus user ' . $user->name
        );

        Alert::success('Success', 'User ' . $user->name . ' deleted successfully');

        return redirect()->route('user.index');
    }

    public function export()
    {
        try {
            $time = now()->format('Y-m-d');

            ActivityLog::createLog(
                'Export User',
                auth()->user()->name . ' mengekspor data user'
            );

            flash('Export User successfully', 'success');

            return Excel::download(new UserExport, 'user_backup_' . $time . '.xlsx');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }

    public function openFormImport()
    {
        $this->formImport = $this->formImport ? 0 : 1;
    }

    public function import()
    {
        try {
            $this->validate([
                'fileImport' => 'required|mimes:xlsx'
            ]);

            Excel::import(new UserImport, $this->fileImport->getRealPath());

            ActivityLog::createLog(
                'Import User',
                auth()->user()->name . ' mengimpor data user'
            );

            Alert::success('Success', 'User imported successfully');

            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }

    public function mount()
    {
        $this->roles = Role::pluck('name', 'id');
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        $users = User::with('roles')
            ->where('name', 'like', $search)
            ->orWhere('email', 'like', $search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.user.user-index', compact('users'))
            ->title('User');
    }
}
