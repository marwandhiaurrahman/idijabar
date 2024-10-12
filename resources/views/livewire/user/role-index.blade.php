<div>
    @if (flash()->message)
        <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
            {{ flash()->message }}
        </x-adminlte-alert>
    @endif
    @if ($formImport)
        <x-adminlte-card title="Import File" theme="secondary">
            <x-adminlte-input-file wire:model='fileImport' name="fileImport"
                placeholder="{{ $fileImport ? $fileImport->getClientOriginalName() : 'Pilih File' }}" igroup-size="sm"
                label="File Import" />
            <x-slot name="footerSlot">
                <x-adminlte-button class="btn-sm" wire:click='import' class="mr-auto btn-sm" icon="fas fa-save"
                    theme="success" label="Import"
                    wire:confirm='Apakah anda yakin akan mengimport file pasien saat ini ?' />
                <x-adminlte-button theme="danger" wire:click='openFormImport' class="btn-sm" icon="fas fa-times"
                    label="Kembali" data-dismiss="modal" />
                <div wire:loading>
                    Loading...
                </div>
            </x-slot>
        </x-adminlte-card>
    @endif
    <div id="editRole">
        @if ($form)
            <x-adminlte-card title="Role" theme="secondary">
                <form>
                    <input type="hidden" wire:model="id" name="id">
                    <x-adminlte-input wire:model="name" fgroup-class="row" label-class="text-left col-3"
                        igroup-class="col-9" igroup-size="sm" name="name" label="Nama" placeholder="Nama Role" />
                    <div class="form-group">
                        <div class="row">
                            @foreach ($permissions as $id => $name)
                                <div class="custom-control custom-checkbox col-md-4">
                                    <input class="custom-control-input" type="checkbox" name="selectedPermissions"
                                        id="permission{{ $id }}" wire:model="selectedPermissions"
                                        value="{{ $name }}">
                                    <label for="permission{{ $id }}"
                                        class="custom-control-label">{{ $name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
                <x-slot name="footerSlot">
                    <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="store"
                        wire:confirm="Apakah anda yakin ingin menyimpan Role ?" theme="success" />
                    <x-adminlte-button wire:click='closeForm' class="btn-sm" label="Tutup" theme="danger"
                        icon="fas fa-times" />
                </x-slot>
            </x-adminlte-card>
        @endif
    </div>
    <x-adminlte-card title="Table Role" theme="secondary">
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-button wire:click='openForm' class="btn-sm mb-2" label="Add Role" theme="success"
                    icon="fas fa-user-plus" />
                <x-adminlte-button wire:click='export'
                    wire:confirm='Apakah anda yakin akan mendownload file saat ini ? ' class="btn-sm mb-2"
                    label="Export" theme="primary" icon="fas fa-upload" />
                <x-adminlte-button wire:click='openFormImport' class="btn-sm mb-2" label="Import" theme="primary"
                    icon="fas fa-download" />
            </div>
            <div class="col-md-6">
                <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian" igroup-size="sm">
                    <x-slot name="appendSlot">
                        <x-adminlte-button wire:click="cari" theme="primary" label="Cari" />
                    </x-slot>
                    <x-slot name="prependSlot">
                        <div class="input-group-text text-primary">
                            <i class="fas fa-search"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
        </div>
        <div class="table-responsive mb">
            <table class="table table-sm table-bordered table-hover  text-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Permission</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $item)
                        <tr wire:key="{{ $item->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->users_count }}</td>
                            <td>
                                <a href="#editRole">
                                    <x-adminlte-button label="Edit" class="btn-xs" icon="fas fa-edit"
                                        wire:click="edit({{ $item->id }})" theme="warning" />
                                </a>
                                <x-adminlte-button label="Hapus" class="btn-xs" icon="fas fa-trash"
                                    wire:click="destroy({{ $item->id }})"
                                    wire:confirm="Apakah anda yakin ingin menghapus Role {{ $item->name }} ?"
                                    theme="danger" />
                            </td>
                            <td>
                                @if ($item->permissions->isNotEmpty())
                                    @foreach ($item->permissions as $permission)
                                        <span class="badge badge-warning">{{ $permission->name }}</span>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $roles->links() }}
    </x-adminlte-card>
</div>
