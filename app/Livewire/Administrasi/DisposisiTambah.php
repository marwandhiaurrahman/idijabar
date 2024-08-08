<?php

namespace App\Livewire\Administrasi;

use App\Models\Disposisi;
use App\Models\Pengurus;
use App\Models\Struktur;
use App\Models\SuratMasuk;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class DisposisiTambah extends Component
{
    public $suratmasuk, $user, $strukturs, $user_disposisi = [''];
    public $disposisi, $instruksi = [], $catatan, $keterangan,  $ditujukan;
    public $form;

    public $ins =  [
        'Untuk ditindaklanjuti' => 'Untuk ditindaklanjuti',
        'Proses sesuai kemampuan / peraturan yang berlaku' => 'Proses sesuai kemampuan / peraturan yang berlaku',
        'Koordinasikan / konfirmasi dengan ybs / instansi terkait' => 'Koordinasikan / konfirmasi dengan ybs / instansi terkait',
        'Untuk dibantu / difasilitasi / dipenuhi sesuai kebutuhan' => 'Untuk dibantu / difasilitasi / dipenuhi sesuai kebutuhan',
        'Pelajari / telaah / sarannya' => 'Pelajari / telaah / sarannya',
        'Wakili / hadiri / terima / laporkan hasilnya' => 'Wakili / hadiri / terima / laporkan hasilnya',
        'Agendakan / persiapkan / koordinasikan' => 'Agendakan / persiapkan / koordinasikan',
        'Jadwalkan ingatkan waktunya' => 'Jadwalkan ingatkan waktunya',
        'Siapkan pointer / sambutan / bahan' => 'Siapkan pointer / sambutan / bahan',
        'Simpan / arsipkan' => 'Simpan / arsipkan',
    ];
    public function tambahPenerima()
    {
        $this->user_disposisi[] = '';
    }
    public function hapusPenerima($index)
    {
        unset($this->user_disposisi[$index]);
        $this->user_disposisi = array_values($this->user_disposisi);
    }
    public function edit()
    {
        $this->form = 1;
        $this->catatan = $this->disposisi?->catatan;
        $this->user_disposisi = explode(';', $this->suratmasuk?->user_disposisi);
        $this->instruksi = explode(';', $this->disposisi?->instruksi);
    }
    public function batal()
    {
        $this->form = 0;
    }
    public function simpan()
    {
        try {
            $disposisi = Disposisi::updateOrCreate(
                [
                    'id_surat' => $this->suratmasuk->id,
                    'jabatan' => $this->user->nama,
                    'user' => $this->user->pengurus?->user_id,
                ],
                [
                    'asal_surat' => $this->suratmasuk->asal_surat,
                    'perihal' => $this->suratmasuk->perihal,
                    'ditujukan' => implode(';', $this->user_disposisi),
                    'instruksi' => implode(';', $this->instruksi),
                    'catatan' => $this->catatan,
                    'keterangan' => $this->keterangan,
                    'tgl_input' => now(),
                    'pic' => $this->user->pengurus?->nama,
                ]
            );
            $suratmasuk = SuratMasuk::find($this->suratmasuk->id);
            $suratmasuk->update([
                'user_disposisi' => implode(';', $this->user_disposisi),
            ]);
            $this->form = 0;
            Alert::success('Berhasil', 'Disposisi telah disimpan');
            $url = route('disposisi.edit') . '?kode=' . $this->suratmasuk->id;
            return redirect()->to($url);
        } catch (\Throwable $th) {
            //throw $th;
            flash($th->getMessage(), 'danger');
        }
    }
    public function verify()
    {
        $disposisi = Disposisi::find($this->disposisi->id);
        $verify = $disposisi->tgl_verify ? null : now();
        $disposisi->update([
            'tgl_verify' => $verify,
        ]);
        Alert::success('Berhasil', 'Disposisi telah diverifikasi');
        $url = route('disposisi.edit') . '?kode=' . $this->suratmasuk->id;
        return redirect()->to($url);
    }
    public function mount($suratmasuk, $user)
    {
        $this->suratmasuk = $suratmasuk;
        $this->user = $user;
        $this->disposisi = Disposisi::where('id_surat', $suratmasuk->id)
            ->where('jabatan', $user->nama)
            ->first();
    }
    public function render()
    {
        $this->strukturs = Struktur::where('struktur_id', $this->user->id)->get();
        return view('livewire.administrasi.disposisi-tambah');
    }
}
