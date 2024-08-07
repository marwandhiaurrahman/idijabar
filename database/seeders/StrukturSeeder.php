<?php

namespace Database\Seeders;

use App\Models\Struktur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StrukturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $strukturs = [
            ['Ketua', null],
            ['Wakil Ketua I', 1],
            ['Wakil Ketua II', 1],
            ['Wakil Ketua III', 1],
            ['Wakil Ketua IV', 1],
            ['Sekretaris', 1],
            ['Sekretaris I', 5],
            ['Sekretaris II', 5],
            ['Sekretaris III', 5],
            ['Ketua Bidang Organisasi', 2],
            ['Ketua Bidang Advokasi dan Kemitraan', 2],
            ['Badan Hukum Pembinaan dan Pembelaan Anggota', 2],
            ['Ketua Bidang Pendidikan, Ilmiah dan Pelayanan Kedokteran', 3],
            ['Bidang P2KB', 3],
            ['BADIN', 3],
            ['Ketua Bidang JKN', 4],
            ['Ketua Bidang Inovasi dan Kewirausahaan', 4],
            ['Ketua Bidang Kesejahteraan', 4],
            ['Ketua Bidang Pengabdian Profesi dan Tanggap Bencana', 5],
            ['Ketua Bidang Pelayanan Kesehatan', 5],
            ['Ketua Bidang Humas dan Media Sosial', 5],
        ];
        foreach ($strukturs as $item) {
            $struktur = Struktur::create([
                'nama' => $item[0],
                'struktur_id' => $item[1],
            ]);
        }
    }
}
