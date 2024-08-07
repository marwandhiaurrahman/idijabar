<?php

namespace App\Livewire\Administrasi;

use App\Models\SuratMasuk as ModelsSuratMasuk;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SuratMasuk extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $suratmasuks;
    public $suratmasuk, $id, $no_surat, $kode_surat, $tgl_surat, $asal_surat, $perihal, $keterangan, $sifat, $jenis, $pic_input, $user_input, $tgl_input, $user_disposisi = [''];
    public $form = 0;
    public function tambahPenerima()
    {
        $this->user_disposisi[] = '';
    }
    public function hapusPenerima($index)
    {
        unset($this->user_disposisi[$index]);
        $this->user_disposisi = array_values($this->user_disposisi);
    }
    public function tambah()
    {
        $this->form = $this->form ? 0 : 1;
        $this->reset(['suratmasuk', 'id', 'no_surat', 'kode_surat', 'tgl_surat', 'asal_surat', 'perihal', 'keterangan', 'sifat', 'jenis', 'pic_input', 'user_input', 'tgl_input',]);
        $this->user_disposisi = [''];
    }
    public function simpan()
    {
        $this->validate([
            'asal_surat' => 'required',
            'perihal' => 'required',
        ]);
        try {
            // if ($this->file) {
            //     $filename = $this->norm . '_' . $this->nama . '_LAB_' . $this->tanggal . now()->format('dmY_His') . '.' . $this->file->getClientOriginalExtension();
            //     $path =  $this->file->storeAs('public/laboratorium',  $filename);
            //     $fileurl = route('landingpage') .  '/storage/laboratorium/' . $filename;
            //     $this->fileurl = route('landingpage') .  '/storage/laboratorium/' . $filename;
            //     $this->filename =  $filename;
            // }
            $suratmasuk = ModelsSuratMasuk::updateOrCreate(
                ['id' => $this->id],
                [
                    'no_surat' => $this->no_surat,
                    'kode_surat' => $this->kode_surat,
                    'tgl_surat' => $this->tgl_surat,
                    'asal_surat' => $this->asal_surat,
                    'perihal' => $this->perihal,
                    'keterangan' => $this->keterangan,
                    'sifat' => $this->sifat,
                    'jenis' => $this->jenis,
                    'pic_input' => auth()->user()->name,
                    'user_input' => auth()->user()->id,
                    'tgl_input' => now(),
                    'user_disposisi' => implode(';', $this->user_disposisi),
                ]
            );
            flash('Surat masuk berhasil disimpan', 'success');
            $this->form = 0;
        } catch (\Throwable $th) {
            flash($th->getMessage(), 'danger');
        }
    }
    public function edit(ModelsSuratMasuk $suratmasuk)
    {
        $this->id = $suratmasuk->id;
        $this->no_surat = $suratmasuk->no_surat;
        $this->kode_surat = $suratmasuk->kode_surat;
        $this->tgl_surat = $suratmasuk->tgl_surat;
        $this->asal_surat = $suratmasuk->asal_surat;
        $this->perihal = $suratmasuk->perihal;
        $this->keterangan = $suratmasuk->keterangan;
        $this->sifat = $suratmasuk->sifat;
        $this->jenis = $suratmasuk->jenis;
        $this->pic_input = $suratmasuk->pic_input;
        $this->user_input = $suratmasuk->user_input;
        $this->tgl_input = $suratmasuk->tgl_input;
        $this->user_disposisi = explode(';', $suratmasuk->user_disposisi);
        $this->form = 1;
    }
    public function hapus(ModelsSuratMasuk $suratmasuk){
        $suratmasuk->delete();
        flash('Surat masuk berhasil dihapus', 'success');
    }
    public function render()
    {
        $this->suratmasuks = ModelsSuratMasuk::get();
        return view('livewire.administrasi.surat-masuk')->title('Surat Masuk');
    }
}
