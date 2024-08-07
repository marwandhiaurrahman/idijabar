<?php

namespace Database\Seeders;

use App\Models\Pengurus;
use App\Models\Struktur;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PengurusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengurus = [
            [
                "nama" => "Dr. Mohamad Luthfi, SpPD, Subsp. HOM (K), FINASIM, MMRS, FISQua",
                "email" => "ketua@gmail.com",
                "password" => bcrypt("123456"),
                "phone" => "089529909036",
                "jabatan" => "Ketua",
            ],
            [
                "nama" => "Dr. Sukwanto Gamalyono, MARS., FISQua",
                "email" => "wakilketua1@gmail.com",
                "password" => bcrypt("123456"),
                "phone" => "089529909036",
                "jabatan" => "Wakil Ketua I",
            ],
            [
                "nama" => "Dr. Bihantoro, M.Kes",
                "email" => "wakilketua2@gmail.com",
                "password" => bcrypt("123456"),
                "phone" => "089529909036",
                "jabatan" => "Wakil Ketua II",
            ],
            [
                "nama" => "Dr. Noor Arida Sofiana, MBA., MH., FISQUA.",
                "email" => "wakilketua3@gmail.com",
                "password" => bcrypt("123456"),
                "phone" => "089529909036",
                "jabatan" => "Wakil Ketua III",
            ],
            [
                "nama" => "Dr. Dadang Rukanta, SpOT.",
                "email" => "wakilketua4@gmail.com",
                "password" => bcrypt("123456"),
                "phone" => "089529909036",
                "jabatan" => "Wakil Ketua IV",
            ],
            [
                "nama" => "Dr. Zakaria Ansori MM.RS",
                "email" => "sekretaris@gmail.com",
                "password" => bcrypt("123456"),
                "phone" => "089529909036",
                "jabatan" => "Sekretaris",
            ],
            [
                "nama" => "Dr. H. Wishnu Pramulo Ady, MHKes",
                "email" => "wakilsekretaris1@gmail.com",
                "password" => bcrypt("123456"),
                "phone" => "089529909036",
                "jabatan" => "Sekretaris I",
            ],
            [
                "nama" => "Dr. Ronny Hadyanto",
                "email" => "wakilsekretaris2@gmail.com",
                "password" => bcrypt("123456"),
                "phone" => "089529909036",
                "jabatan" => "Sekretaris II",
            ],
            [
                "nama" => "Dr. Isti Noviani,SpPK., Subsp. H.K.(K)., MMRS.",
                "email" => "wakilsekretaris3@gmail.com",
                "password" => bcrypt("123456"),
                "phone" => "089529909036",
                "jabatan" => "Sekretaris III",
            ],
            [
                "nama" => "Dr. Aria Firmansyah",
                "email" => "kabidorganisasi@gmail.com",
                "password" => bcrypt("123456"),
                "phone" => "089529909036",
                "jabatan" => "Ketua Bidang Organisasi",
            ],
            [
                "nama" => "Dr. Asep Hermana, SpB",
                "email" => "kabidadvokasimitra@gmail.com",
                "password" => bcrypt("123456"),
                "phone" => "089529909036",
                "jabatan" => "Ketua Bidang Advokasi dan Kemitraan",
            ],
            [
                "nama" => "Dr. Budi Santoso, SpOG., MHKes., MMRS",
                "email" => "kabidhukumbinabela@gmail.com",
                "password" => bcrypt("123456"),
                "phone" => "089529909036",
                "jabatan" => "Badan Hukum Pembinaan dan Pembelaan Anggota",
            ],
            [
                "nama" => "Dr. Indra Wijaya, SpPD-KHOM",
                "email" => "kabidpendidikilmiah@gmail.com",
                "password" => bcrypt("123456"),
                "phone" => "089529909036",
                "jabatan" => "Ketua Bidang Pendidikan, Ilmiah dan Pelayanan Kedokteran",
            ],
            [
                "nama" => "dr. Kote Noordinata, SpTHT-BKL., MKes",
                "email" => "p2kb@gmail.com",
                "password" => bcrypt("123456"),
                "phone" => "089529909036",
                "jabatan" => "Bidang P2KB",
            ],
            [
                "nama" => "dr. Pipit Tresnawati, MM.",
                "email" => "badin@gmail.com",
                "password" => bcrypt("123456"),
                "phone" => "089529909036",
                "jabatan" => "BADIN",
            ],
        ];
        foreach ($pengurus as $item) {
            $jabatan = Struktur::where('nama', $item["jabatan"])->first();
            $user = User::create([
                "name" => $item["nama"],
                "username" => $item["email"],
                "email" => $item["email"],
                "phone" => $item["phone"],
                "password" => $item["password"],
                "email_verified_at" => now(),
            ]);
            $user->assignRole($item["jabatan"]);
            Pengurus::create([
                "nama" => $item["nama"],
                "email" => $item["email"],
                "phone" => $item["phone"],
                "struktur_id" => $jabatan->id,
                "user_id" => $user->id,
            ]);
        }
    }
}
