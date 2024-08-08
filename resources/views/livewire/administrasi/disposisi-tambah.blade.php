<div>
    <i class="fas fa-file-signature bg-yellow"></i>
    <div class="timeline-item">
        <span class="time"><i class="fas fa-clock"></i> {{ $disposisi->updated_at ?? '-' }}</span>
        <h3 class="timeline-header">Surat Disposisi oleh <b>{{ $user->nama }}
                ({{ $user->pengurus?->nama }})
            </b></h3>
        <div class="timeline-body">
            @if (flash()->message)
                <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                    {{ flash()->message }}
                </x-adminlte-alert>
            @endif
            @if ($form)
                <form>
                    <label>Disposisi Ditujukan Kepada</label>
                    @foreach ($user_disposisi as $index => $diag)
                        <div class="row" wire:key="diagnosa-field-{{ $index }}">
                            <div class="col-lg-10 col-10">
                                <x-adminlte-input wire:model="user_disposisi.{{ $index }}" list="diagnosalist"
                                    name="user_disposisi[]" placeholder="Penerima Disposisi" igroup-size="sm" />
                            </div>
                            <div class="col-lg-2 col-2">
                                <button wire:click.prevent="hapusPenerima({{ $index }})"
                                    class="btn btn-danger btn-sm">Hapus</button>
                            </div>
                        </div>
                    @endforeach
                    <x-adminlte-button class="btn-sm" wire:click='tambahPenerima' label="Tambah Penerima Disposisi"
                        theme="success" icon="fas fa-plus" />
                    <datalist id="diagnosalist">
                        @foreach ($strukturs as $item)
                            <option value="{{ $item->nama }}">{{ $item->pengurus?->nama }}</option>
                        @endforeach
                    </datalist>
                    <br><br>
                    <label>Disposisi :</label>
                    <div class="form-group">
                        @foreach ($ins as $value => $label)
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="{{ $value }}"
                                    wire:model="instruksi" value="{{ $value }}">
                                <label for="{{ $value }}"
                                    class="custom-control-label">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>
                    <x-adminlte-textarea wire:model="catatan" label="Catatan Disposisi" name="catatan"
                        igroup-size="sm" />
                </form>
            @else
                <table>
                    <tr class="align-top">
                        <td class="text-nowrap">Ditujukan Kepada</td>
                        <td>:</td>
                        <td>
                            @if ($disposisi)
                                @foreach (explode(';', $disposisi->ditujukan) as $item)
                                    <span class="badge badge-info">{{ $item }}</span>
                                @endforeach
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td class="text-nowrap">Harap Dengan Hormat</td>
                        <td>:</td>
                        <td>
                            @if ($disposisi)
                                @foreach (explode(';', $disposisi?->instruksi) as $perintah)
                                    {{ $perintah }} <br>
                                @endforeach
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td class="text-nowrap">Catatan Disposisi</td>
                        <td>:</td>
                        <td>{{ $disposisi->catatan ?? '-' }}</td>
                    </tr>
                </table>
            @endif
        </div>
        <div class="timeline-footer">
            @if ($form)
                <x-adminlte-button class="btn-sm" wire:click='simpan' label="Simpan" theme="success"
                    icon="fas fa-save" />
                <x-adminlte-button class="btn-sm" wire:click='batal' label="Batal" theme="danger"
                    icon="fas fa-times" />
            @else
                @if ($disposisi)
                    @if (!$disposisi?->tgl_verify)
                        <x-adminlte-button class="btn-sm" wire:click='edit' label="Edit Disposisi" theme="warning"
                            icon="fas fa-edit" />
                    @endif
                    <x-adminlte-button class="btn-sm" wire:click='verify' label="Verifikasi" theme="success"
                        icon="fas fa-check" />
                @else
                    <x-adminlte-button class="btn-sm" wire:click='edit' label="Edit Disposisi" theme="warning"
                        icon="fas fa-edit" />
                @endif
            @endif
        </div>
    </div>
</div>
