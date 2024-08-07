<?php

namespace App\Livewire\Administrasi;

use App\Models\SuratMasuk;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DisposisiIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $suratmasuks,$penguruss;
    public $suratmasuk, $id, $no_surat, $kode_surat, $tgl_surat, $asal_surat, $perihal, $keterangan, $sifat, $jenis, $pic_input, $user_input, $tgl_input, $user_disposisi = [''];
    public $form = 0;
    public function render()
    {
        $this->suratmasuks = SuratMasuk::get();

        return view('livewire.administrasi.disposisi-index')->title('Surat Disposisi');
    }
}
