<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
    </div>
    <div class="col-md-12" id="formuser">
        @if ($formTambah)
            <x-adminlte-card theme="success" title="Formulir User">
                <form action="">
                    <input type="hidden" name="id" wire:model='id'>
                    <x-adminlte-input wire:model='name' label="Nama" name="name" type="email" />
                    <x-adminlte-input wire:model='email' label="Email" name="email" type="email" />
                    <x-adminlte-input wire:model='password' label="Password" name="password" type="password" />
                </form>
                <x-slot name="footerSlot">
                    <x-adminlte-button class="btn-sm mb-2" wire:click='simpan' label="Simpan" theme="success"
                        icon="fas fa-save" />
                </x-slot>
            </x-adminlte-card>
        @endif
    </div>
    <div class="col-md-12">
        <x-adminlte-card theme="secondary" title="Data User">
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-button class="btn-sm mb-2" wire:click='tambah' label="Tambah" theme="success"
                        icon="fas fa-plus" />
                </div>
                <div class="col-md-6"></div>
            </div>
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nama</th>
                        <th>Roles</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Verified</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @foreach ($item->getRoleNames() as $role)
                                    {{ $role }}
                                @endforeach
                            </td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->email_verified_at }}</td>
                            <td>
                                <x-adminlte-button class="btn-xs" wire:click="edit('{{ $item->id }}')"
                                    label="Edit" theme="warning" icon="fas fa-edit" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-adminlte-card>
    </div>
</div>
