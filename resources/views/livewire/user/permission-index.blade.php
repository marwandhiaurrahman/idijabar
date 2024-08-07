<div>
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
    </div>
    @if ($formPermission)
        <x-adminlte-card theme="success" title="Formulir User">
            <form action="">
                <input type="hidden" name="id" wire:model='id'>
                <x-adminlte-input wire:model='name' label="Nama" name="name" type="email" />
            </form>
            <x-slot name="footerSlot">
                <x-adminlte-button class="btn-sm mb-2" wire:click='simpanPermission' label="Simpan" theme="success"
                    icon="fas fa-save" />
            </x-slot>
        </x-adminlte-card>
    @endif
    <x-adminlte-card theme="secondary" title="Data Permission">
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-button class="btn-sm mb-2" wire:click='tambahPermission' label="Tambah" theme="success"
                    icon="fas fa-plus" />
            </div>
            <div class="col-md-6"></div>
        </div>
        <table class="table table-sm table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nama Permission</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <x-adminlte-button class="btn-xs" wire:click="edit('{{ $item->id }}')" label="Edit"
                                theme="warning" icon="fas fa-edit" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-adminlte-card>
</div>
