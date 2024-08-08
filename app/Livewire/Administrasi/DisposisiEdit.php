<?php

namespace App\Livewire\Administrasi;

use App\Models\Struktur;
use App\Models\SuratMasuk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DisposisiEdit extends Component
{
    public $suratmasuk, $kode, $id, $no_surat, $kode_surat, $tgl_surat, $asal_surat, $perihal, $keterangan, $sifat, $jenis, $pic_input, $user_input, $tgl_input, $user_disposisi = [''];
    protected $queryString = ['kode'];
    public $formlampiran = 0;
    public $penerima;
    protected $listeners = ['refreshPage' => '$refresh'];
    public function lihatLampiran()
    {
        $this->formlampiran = $this->formlampiran ? 0 : 1;
    }
    public function selesai()
    {
        $this->suratmasuk->update([
            'pic_selesai' => auth()->user()->name,
            'user_selesai' => auth()->user()->id,
            'tgl_selesai' => now(),
        ]);
        Alert::success('Berhasil', 'Disposisi telah diselesaikan');
        $url = route('disposisi.edit') . '?kode=' . $this->suratmasuk->id;
        return redirect()->to($url);
    }
    public function batalselesai()
    {
        $this->suratmasuk->update([
            'pic_selesai' => null,
            'user_selesai' => null,
            'tgl_selesai' => null,
        ]);
        Alert::success('Berhasil', 'Disposisi batal telah diselesaikan');
        $url = route('disposisi.edit') . '?kode=' . $this->suratmasuk->id;
        return redirect()->to($url);
    }
    public function print(Request $request)
    {
        $suratmasuk = SuratMasuk::find($request->kode);
        $disposisis = $suratmasuk->disposisis;
        $qrurl = QrCode::format('png')->size(100)->generate('test');
        $url = "data:image/png;base64," . base64_encode($qrurl);
        $fileurl = QrCode::format('png')->size(100)->generate(route('landingpage') . "/storage/suratmasuk/" . $suratmasuk->filename);
        $fileurl = "data:image/png;base64," . base64_encode($fileurl);
        foreach ($disposisis as $disposisi) {
            $verify = QrCode::format('png')->size(100)->generate($disposisi->tgl_verify);
            $verify = "data:image/png;base64," . base64_encode($verify);
            $disposisi->qrverify = $verify;
        }
        // http://idijabar.test
        // return view('livewire.administrasi.disposisi-print', compact('disposisis', 'suratmasuk'));
        $pdf = Pdf::loadView('livewire.administrasi.disposisi-print', compact('disposisis', 'suratmasuk', 'url', 'fileurl'));
        return $pdf->stream('disposisi.pdf');
        // // ttd petugas
        // $ttdpetugas = QrCode::format('png')->size(150)->generate($antrian->pic4->name ?? auth()->user()->name);
        // $ttdpetugas = "data:image/png;base64," . base64_encode($ttdpetugas);
        // // ttd d pasien
        // $qrttdpasien = QrCode::format('png')->size(150)->generate($antrian->nama);
        // $ttdpasien = "data:image/png;base64," . base64_encode($qrttdpasien);
        // $pdf = Pdf::loadView('print.pdf_notarajal', compact('resepobatdetails', 'resepobat', 'antrian', 'url', 'ttdpetugas','ttdpasien'));
        // return $pdf->stream('etiket.pdf');

    }
    public function mount()
    {
        $this->suratmasuk = SuratMasuk::find($this->kode);
        $user =  explode(';', $this->suratmasuk->user_disposisi);
        $this->penerima = Struktur::whereIn('nama', $user)->get();
        return redirect()->back();
    }
    public function render()
    {
        return view('livewire.administrasi.disposisi-edit')->title('Surat Disposisi');
    }
}
