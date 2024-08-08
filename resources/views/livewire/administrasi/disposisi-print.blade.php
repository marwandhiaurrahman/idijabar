@extends('livewire.print.pdf_layout')
@section('title', 'Print Disposisi')

@section('content')
    <table class="table table-sm table-bordered" style="font-size: 12px;">
        <tr>
            <td width="10%" class="text-center" style="vertical-align: top;">
                <img src="{{ public_path('idijabar/logoidi.png') }}" style="height: 50px;">
                {{-- <img src="{{ asset('idijabar/logoidi.png') }}" style="height: 30px;"> --}}
            </td>
            <td width="60%" style="vertical-align: top;">
                <b style="font-size: 15px;">IKATAN DOKTER INDONESIA <br>WILAYAH JAWA BARAT</b><br>
                {{-- Jl. Raya Merdeka Utama Ciledug Desa Ciledug Kulon, <br>
                Kec. Ciledug, Kabupaten Cirebon, Jawa Barat 45682 <br> --}}
                www.idijabar.com
            </td>
            <td width="30%" style="vertical-align: top;" class="text-center">
                {{-- <img src="{{ $url }}" width="50px"> --}}
            </td>
        </tr>
        <tr class="text-center" style="background: yellow">
            <td colspan="3">
                <b>SURAT DISPOSISI</b>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table class="table-borderless">

                    <tr>
                        <td>Nomor Disposisi</td>
                        <td>:</td>
                        <td>{{ $suratmasuk->id }}{{ \Carbon\Carbon::now()->format('/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Surat</td>
                        <td>:</td>
                        <td>{{ $suratmasuk->no_surat }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Surat</td>
                        <td>:</td>
                        <td>{{ $suratmasuk->tgl_surat }}</td>
                    </tr>
                    <tr>
                        <td>Asal Surat</td>
                        <td>:</td>
                        <td><b>{{ $suratmasuk->asal_surat }}</b></td>
                    </tr>
                    <tr>
                        <td>Perihal Surat</td>
                        <td>:</td>
                        <td>{{ $suratmasuk->perihal_surat }}</td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>{{ $suratmasuk->keterangan }}</td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="table-borderless">
                    <tr>
                        <td>Jenis Surat</td>
                        <td>:</td>
                        <td>{{ $suratmasuk->jenis }}</td>
                    </tr>
                    <tr>
                        <td>Sifat Surat</td>
                        <td>:</td>
                        <td>{{ $suratmasuk->sifat }}</td>
                    </tr>
                    <tr>
                        <td class="nowrap">Lampiran</td>
                        <td>:</td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ $fileurl }}" width="70px">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        @foreach ($disposisis as $disposisi)
            <tr>
                <td colspan="3">
                    <table class="table-borderless">
                        <tr>
                            <td>Disposisi Oleh</td>
                            <td>:</td>
                            <td><b>{{ $disposisi->jabatan }}</b><br>{{ $disposisi->pic }}</td>
                        </tr>
                        <tr>
                            <td>Disposisi</td>
                            <td>:</td>
                            <td>{{ $disposisi->instruksi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td>:</td>
                            <td>{{ $disposisi->catatan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pengisian</td>
                            <td>:</td>
                            <td>{{ $disposisi->tgl_input ?? '-' }}</td>
                        </tr>
                        {{-- <tr>
                            <td>Tanggal Verifikasi</td>
                            <td>:</td>
                            <td>{{ $disposisi->tgl_verify ?? '-' }}</td>
                        </tr> --}}
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <img src="{{ $disposisi->qrverify }}" width="50px">
                            </td>
                        </tr>
                    </table>
                </td>
                {{-- <td>
                    <img src="{{ $disposisi->qrverify }}" width="50px">
                </td> --}}
            </tr>
        @endforeach
        <tr>
            <td colspan="2">
                <table class="table-borderless">
                    <tr>
                        <td>Penerima Disposisi</td>
                        <td>:</td>
                        <td>{{ $suratmasuk->pic_selesai }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Selesai Disposisi</td>
                        <td>:</td>
                        <td>{{ $suratmasuk->tgl_selesai }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Cetak Disposisi</td>
                        <td>:</td>
                        <td>{{ now() }}</td>
                    </tr>

                </table>
            </td>
            <td>
                <i>Disposisi ini telah diisi dan diverifikasi secara elektronik oleh Sistem IDI Jabar</i>

            </td>
        </tr>
    </table>
    <style>
        @page {
            size: "A4";
            /* Misalnya ukuran A4 */
        }
    </style>
@endsection
