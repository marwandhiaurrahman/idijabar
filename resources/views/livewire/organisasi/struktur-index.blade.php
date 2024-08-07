<div>
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
    </div>
    @if ($form)
        <x-adminlte-card theme="success" title="Formulir Struktur">
            <form action="">
                <input type="hidden" name="id" wire:model='id'>
                <x-adminlte-input wire:model='nama' label="Nama" name="nama" />
                <x-adminlte-select wire:model='struktur_id' name="struktur_id" label="Dibawah Koordinasi">
                    <option value="">Pilih Dibawah Koordinasi</option>
                    @foreach ($strukturs as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </x-adminlte-select>
            </form>
            <x-slot name="footerSlot">
                <x-adminlte-button class="btn-sm mb-2" wire:click='simpan' label="Simpan" theme="success"
                    icon="fas fa-save" />
            </x-slot>
        </x-adminlte-card>
    @endif
    <x-adminlte-card theme="secondary" title="Data Stuktur">
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
                    <th>Stuktur Jabatan</th>
                    <th>Dibawah Koordinasi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($strukturs as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->atasan?->nama }}</td>
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
