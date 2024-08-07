<?php

namespace App\Livewire\Organisasi;

use App\Models\Pengurus;
use App\Models\Struktur;
use Livewire\Component;

class PengurusIndex extends Component
{
    public $penguruss, $strukturs;
    public $pengurus, $id, $nama, $struktur_id;
    public $form = 0;
    public function tambah()
    {
        $this->form = $this->form ? 0 : 1;
        $this->strukturs = Struktur::get();
        $this->reset('pengurus', 'id', 'nama', 'struktur_id');
    }
    public function simpan()
    {
        $pengurus = Pengurus::updateOrCreate(
            ['id' => $this->id],
            [
                'nama' => $this->nama,
                'struktur_id' => $this->struktur_id
            ],
        );
        $this->form = 0;
        flash('Pengurus berhasil disimpan', 'success');
    }
    public function render()
    {
        $this->penguruss = Pengurus::get();
        return view('livewire.organisasi.pengurus-index')->title('Pengurus Organisasi');
    }
}
