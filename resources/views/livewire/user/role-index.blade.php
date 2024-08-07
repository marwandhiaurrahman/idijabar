<div>
    @if (flash()->message)
        <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
            {{ flash()->message }}
        </x-adminlte-alert>
    @endif
    <div id="formRole">
        @if ($form)
            <x-adminlte-card theme="success" title="Formulir User">
                <form action="">
                    <input type="hidden" name="id" wire:model='id'>
                    <x-adminlte-input wire:model='name' label="Nama" name="name" />
                    <div class="form-group">
                        <div class="row">
                            @foreach ($permissions as $id => $name)
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox ">
                                        <input class="custom-control-input" type="checkbox" name="selectedPermissions"
                                            id="permission{{ $id }}" wire:model="selectedPermissions"
                                            value="{{ $name }}">
                                        <label for="permission{{ $id }}"
                                            class="custom-control-label">{{ $name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
                <x-slot name="footerSlot">
                    <x-adminlte-button class="btn-sm" wire:click='simpan' label="Simpan" theme="success"
                        icon="fas fa-save" />
                    <x-adminlte-button class="btn-sm" wire:click='batal' label="Batal" theme="danger"
                        icon="fas fa-times" />
                </x-slot>
            </x-adminlte-card>
        @endif
    </div>
    <x-adminlte-card theme="secondary" title="Data Permission">
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
                    <th>Permission</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            @foreach ($item->permissions as $permission)
                                <span class="badge badge-primary">{{ $permission->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="#formRole">
                                <x-adminlte-button class="btn-xs" wire:click="edit('{{ $item->id }}')"
                                    label="Edit" theme="warning" icon="fas fa-edit" />
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-adminlte-card>
</div>
