<?php

namespace App\Livewire\Organisasi;

use App\Models\Struktur;
use Livewire\Component;

class StrukturIndex extends Component
{
    public $strukturs, $struktur, $id, $nama, $struktur_id;
    public $form = 0;

    public function tambah()
    {
        $this->form = $this->form ? 0 : 1;
        $this->strukturs = Struktur::get();
        $this->reset('struktur','id','nama','struktur_id');
    }
    public function simpan()
    {
        $struktur = Struktur::updateOrCreate(
            ['id' => $this->id],
            [
                'nama' => $this->nama,
                'struktur_id' => $this->struktur_id
            ],
        );
        $this->form = 0;
        flash('Data berhasil disimpan','success');
    }
    public function edit(Struktur $struktur)
    {
        $this->struktur = $struktur;
        $this->id = $struktur->id;
        $this->nama = $struktur->nama;
        $this->struktur_id = $struktur->struktur_id;
        $this->strukturs = Struktur::get();
        $this->form = 1;
    }
    public function render()
    {
        $this->strukturs = Struktur::get();
        return view('livewire.organisasi.struktur-index')->title('Struktur Organisasi');
    }
}
