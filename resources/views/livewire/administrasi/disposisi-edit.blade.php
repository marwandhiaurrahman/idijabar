<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
    </div>
    {{-- <div class="col-md-12">
        <x-adminlte-card theme="secondary" title="Surat Disposisi">
            <div class="row">
                <div class="col-md-6">
                    <table>
                        <tr class="align-top">
                            <td class="text-nowrap">Nomor Surat</td>
                            <td>:</td>
                            <td>{{ $suratmasuk->no_surat ?? '-' }}</td>
                        </tr>
                        <tr class="align-top">
                            <td class="text-nowrap">Kode Surat</td>
                            <td>:</td>
                            <td>{{ $suratmasuk->kode_surat ?? '-' }}</td>
                        </tr>
                        <tr class="align-top">
                            <td class="text-nowrap">Tanggal</td>
                            <td>:</td>
                            <td>{{ $suratmasuk->tgl_surat ?? '-' }}</td>
                        </tr>
                        <tr class="align-top">
                            <td class="text-nowrap">Asal Surat</td>
                            <td>:</td>
                            <td>
                                <b>{{ $suratmasuk->asal_surat ?? '-' }}</b>
                            </td>
                        </tr>
                        <tr class="align-top">
                            <td>Perihal</td>
                            <td>:</td>
                            <td>{{ $suratmasuk->perihal ?? '-' }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>{{ $suratmasuk->keterangan ?? '-' }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Sifat</td>
                            <td>:</td>
                            <td>{{ $suratmasuk->sifat ?? '-' }}</td>
                        </tr>
                        <tr class="align-top">
                            <td>Jenis</td>
                            <td>:</td>
                            <td>{{ $suratmasuk->jenis ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </x-adminlte-card>
    </div> --}}
    <div class="col-md-12">
        <div class="timeline">
            <div class="time-label">
                @if ($suratmasuk->tgl_selesai)
                    <span
                        class="bg-green">{{ \Carbon\Carbon::parse($suratmasuk->tgl_selesai)->translatedFormat('l, d M Y') }}
                    </span>
                    <span class="bg-green">Disposisi Selesai</span>
                @else
                    <span
                        class="bg-red">{{ \Carbon\Carbon::parse($suratmasuk->tgl_input)->translatedFormat('l, d M Y') }}</span>
                    <span class="bg-red">Disposisi Belum Selesai</span>
                @endif

            </div>
            <div>
                <i class="fas fa-envelope bg-blue"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> {{ $suratmasuk->tgl_input }}</span>
                    <h3 class="timeline-header"><b>Surat Masuk</b> diupload oleh {{ $suratmasuk->pic_input }}</h3>
                    <div class="timeline-body">
                        <table>
                            <tr class="align-top">
                                <td class="text-nowrap">Nomor Surat</td>
                                <td>:</td>
                                <td>{{ $suratmasuk->no_surat ?? '-' }}</td>
                            </tr>
                            <tr class="align-top">
                                <td class="text-nowrap">Kode Surat</td>
                                <td>:</td>
                                <td>{{ $suratmasuk->kode_surat ?? '-' }}</td>
                            </tr>
                            <tr class="align-top">
                                <td class="text-nowrap">Tanggal</td>
                                <td>:</td>
                                <td>{{ $suratmasuk->tgl_surat ?? '-' }}</td>
                            </tr>
                            <tr class="align-top">
                                <td class="text-nowrap">Asal Surat</td>
                                <td>:</td>
                                <td>
                                    <b>{{ $suratmasuk->asal_surat ?? '-' }}</b>
                                </td>
                            </tr>
                            <tr class="align-top">
                                <td>Perihal</td>
                                <td>:</td>
                                <td>{{ $suratmasuk->perihal ?? '-' }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Keterangan</td>
                                <td>:</td>
                                <td>{{ $suratmasuk->keterangan ?? '-' }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Sifat</td>
                                <td>:</td>
                                <td>{{ $suratmasuk->sifat ?? '-' }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Jenis</td>
                                <td>:</td>
                                <td>{{ $suratmasuk->jenis ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="timeline-footer">
                        <a href="{{ route('disposisi.print') }}?kode={{ $suratmasuk->id }}" target="_blank">
                            <x-adminlte-button class="btn-sm" label="Cetak Disposisi" theme="warning"
                                icon="fas fa-print" />
                        </a>
                    </div>
                </div>
            </div>
            <div>
                <i class="fas fa-file-alt bg-primary"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> {{ $suratmasuk->tgl_input }}</span>
                    <h3 class="timeline-header"><b>Lampiran Surat Masuk</b> {{ $suratmasuk->asal_surat }}</h3>
                    <div class="timeline-body">
                        <iframe class="embed-responsive-item" width="100%" height="400"
                            src="{{ route('landingpage') }}/storage/suratmasuk/{{ $suratmasuk->filename }}"></iframe>
                    </div>
                    <div class="timeline-footer">
                        <a href="{{ route('landingpage') }}/storage/suratmasuk/{{ $suratmasuk->filename }}"
                            target="_blank">
                            <x-adminlte-button class="btn-sm" label="Download Lampiran" theme="primary"
                                icon="fas fa-download" />
                        </a>
                    </div>
                </div>
            </div>
            @foreach ($penerima as $user)
                @livewire('administrasi.disposisi-tambah', ['suratmasuk' => $suratmasuk, 'user' => $user, 'lazy' => true])
            @endforeach
            <div>
                <i class="fas fa-file-contract bg-success"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> {{ $suratmasuk->tgl_selesai }}</span>
                    <h3 class="timeline-header"><b>Disposisi Selesai</b> {{ $suratmasuk->pic_selesai }}</h3>
                    <div class="timeline-body">
                        @if ($suratmasuk->tgl_selesai)
                            Disposisi telah diselesaikan oleh {{ $suratmasuk->pic_selesai }} pada tanggal
                            {{ $suratmasuk->tgl_selesai }}
                        @endif
                    </div>
                    <div class="timeline-footer">
                        @if ($suratmasuk->tgl_selesai)
                            <x-adminlte-button class="btn-sm"
                                wire:confirm='Apakah anda yakin akan membatalkan bahwa disposisi ini sudah selesai ?'
                                wire:click='batalselesai' label="Batal Selesai" theme="danger" icon="fas fa-times" />
                        @else
                            <x-adminlte-button class="btn-sm"
                                wire:confirm='Apakah anda yakin bahwa disposisi ini sudah selesai ?'
                                wire:click='selesai' label="Selesai" theme="success" icon="fas fa-check" />
                        @endif

                    </div>
                </div>
            </div>
            {{-- <div>
                <i class="fas fa-user bg-green"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                    </h3>
                </div>
            </div>
            <div class="time-label">
                <span class="bg-green">3 Jan. 2014</span>
            </div>
            <div>
                <i class="fa fa-camera bg-purple"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                    <div class="timeline-body">
                        <img src="https://placehold.it/150x100" alt="...">
                        <img src="https://placehold.it/150x100" alt="...">
                        <img src="https://placehold.it/150x100" alt="...">
                        <img src="https://placehold.it/150x100" alt="...">
                        <img src="https://placehold.it/150x100" alt="...">
                    </div>
                </div>
            </div>
            <div>
                <i class="fas fa-video bg-maroon"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> 5 days ago</span>

                    <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>

                    <div class="timeline-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs"
                                allowfullscreen=""></iframe>
                        </div>
                    </div>
                    <div class="timeline-footer">
                        <a href="#" class="btn btn-sm bg-maroon">See comments</a>
                    </div>
                </div>
            </div>
            <div>
                <i class="fas fa-clock bg-gray"></i>
            </div> --}}
        </div>
    </div>
</div>
