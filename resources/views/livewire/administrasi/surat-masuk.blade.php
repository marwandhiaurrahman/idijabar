<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <div id="formsurat">
            @if ($form)
                <x-adminlte-card theme="success" title="Formulir Surat Masuk">
                    <form action="">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="id" wire:model='id'>
                                <x-adminlte-input wire:model='no_surat' label="No Surat" name="no_surat"
                                    fgroup-class="row" label-class="text-left col-4" igroup-class="col-8"
                                    igroup-size="sm" />
                                <x-adminlte-input wire:model='kode_surat' label="Kode Surat" name="kode_surat"
                                    fgroup-class="row" label-class="text-left col-4" igroup-class="col-8"
                                    igroup-size="sm" />
                                <x-adminlte-input wire:model='tgl_surat' label="Tgl Surat" name="tgl_surat"
                                    type="date" fgroup-class="row" label-class="text-left col-4" igroup-class="col-8"
                                    igroup-size="sm" />
                                <x-adminlte-input wire:model='asal_surat' label="Asal Surat" name="asal_surat"
                                    fgroup-class="row" label-class="text-left col-4" igroup-class="col-8"
                                    igroup-size="sm" />
                                <x-adminlte-textarea wire:model="perihal" label="Perihal" name="perihal"
                                    fgroup-class="row" label-class="text-left col-4" igroup-class="col-8"
                                    igroup-size="sm" />
                                <x-adminlte-textarea wire:model="keterangan" label="Keterangan" name="keterangan"
                                    fgroup-class="row" label-class="text-left col-4" igroup-class="col-8"
                                    igroup-size="sm" />
                                <div class="form-group row">
                                    <label for="file" class="text-left col-4">
                                        File Surat
                                    </label>
                                    <div class="input-group input-group-sm col-8">
                                        <input id="file" type="file" name="file" class="form-control"
                                            wire:model="file">
                                    </div>
                                    <div class="col-12">
                                        {{ $filename }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <x-adminlte-input wire:model="sifat" fgroup-class="row" label-class="text-left col-4"
                                    igroup-class="col-8" igroup-size="sm" name="sifat" label="Sifat" />
                                <x-adminlte-input wire:model="jenis" fgroup-class="row" label-class="text-left col-4"
                                    igroup-class="col-8" igroup-size="sm" name="jenis" label="Jenis" />
                                <label>Penerima Disposisi</label>
                                @foreach ($user_disposisi as $index => $diag)
                                    <div class="row" wire:key="diagnosa-field-{{ $index }}">
                                        <div class="col-lg-10 col-10">
                                            <x-adminlte-input wire:model="user_disposisi.{{ $index }}"
                                                list="diagnosalist" name="user_disposisi[]"
                                                placeholder="Penerima Disposisi" igroup-size="sm" />
                                        </div>
                                        <div class="col-lg-2 col-2">
                                            <button wire:click.prevent="hapusPenerima({{ $index }})"
                                                class="btn btn-danger btn-sm">Hapus</button>
                                        </div>
                                    </div>
                                @endforeach
                                <x-adminlte-button class="btn-sm" wire:click='tambahPenerima'
                                    label="Tambah Penerima Disposisi" theme="success" icon="fas fa-plus" />
                                <datalist id="diagnosalist">
                                    @foreach ($penguruss as $item)
                                        <option value="{{ $item->jabatan?->nama }}">{{ $item->nama }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                        </div>

                    </form>
                    <x-slot name="footerSlot">
                        <x-adminlte-button class="btn-sm" wire:click='simpan' label="Simpan Surat Masuk"
                            theme="success" icon="fas fa-save" />
                    </x-slot>
                </x-adminlte-card>
            @endif
        </div>
        <x-adminlte-card theme="secondary" title="Data Surat Masuk">
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-button class="btn-sm mb-2" wire:click='tambah' label="Tambah" theme="success"
                        icon="fas fa-plus" />
                </div>
                <div class="col-md-6"></div>
            </div>
            <ul class="products-list product-list-in-card pl-2 pr-2">
                @foreach ($suratmasuks as $item)
                    <li class="item" wire:click="edit('{{ $item->id }}')">
                        <a href="#formsurat">
                            <div class="product-img rounded-circle bg-danger">
                                <i class="fas fa-envelope fa-xl m-2 d-flex p-2 "></i>
                            </div>
                            <div class="product-info">
                                <div class="product-title">
                                    {{ $item->asal_surat }}
                                    <span class="badge badge-danger float-right">Belum</span>
                                </div>
                                <span class="product-description">
                                    <b>{{ $item->perihal }}</b><br>
                                    {{ $item->keterangan }}
                                </span>
                            </div>
                        </a>

                    </li>
                @endforeach
            </ul>
            {{-- <table class="table table-sm table-bordered table-hover table-responsive-sm">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No. Surat</th>
                        <th>Tgl Surat</th>
                        <th>Asal Surat</th>
                        <th>Perihal</th>
                        <th>Keterangan</th>
                        <th>Disposisi</th>
                        <th>Tgl Input</th>
                        <th>PIC Input</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suratmasuks as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->no_surat }}</td>
                            <td>{{ $item->tgl_surat }}</td>
                            <td>{{ $item->asal_surat }}</td>
                            <td>{{ $item->perihal }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->pic_input }}</td>
                            <td>
                                <x-adminlte-button class="btn-xs" wire:click="edit('{{ $item->id }}')"
                                    label="Edit" theme="warning" icon="fas fa-edit" />
                                <x-adminlte-button class="btn-xs"
                                    wire:confirm='Apakah anda yakin akan menghapus surat masuk yang berasal dari {{ $item->asal_surat }} ?'
                                    wire:click="hapus('{{ $item->id }}')" label="Hapus" theme="danger"
                                    icon="fas fa-trash" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> --}}
        </x-adminlte-card>
    </div>

</div>
