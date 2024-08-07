<?php

namespace App\Livewire\Administrasi;

use App\Models\Struktur;
use App\Models\SuratMasuk;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

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
