<?php

namespace App\Livewire\Administrasi;

use App\Models\Struktur;
use App\Models\SuratMasuk;
use Livewire\Component;

class DisposisiEdit extends Component
{
    public $suratmasuk, $kode, $id, $no_surat, $kode_surat, $tgl_surat, $asal_surat, $perihal, $keterangan, $sifat, $jenis, $pic_input, $user_input, $tgl_input, $user_disposisi = [''];
    protected $queryString = ['kode'];
    public $formlampiran = 0;
    public $penerima;

    public function lihatLampiran()
    {
        $this->formlampiran = $this->formlampiran ? 0 : 1;
    }
    public function mount()
    {
        $this->suratmasuk = SuratMasuk::find($this->kode);
        $user =  explode(';', $this->suratmasuk->user_disposisi);
        $this->penerima = Struktur::whereIn('nama', $user)->get();
    }
    public function render()
    {
        return view('livewire.administrasi.disposisi-edit')->title('Surat Disposisi');
    }
}
