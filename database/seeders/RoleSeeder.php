<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = [
            'Admin',

        ];
        foreach ($roles as $item) {
            $permission = Permission::create(['name' => Str::slug($item)]);
            $role = Role::create(['name' => $item]);
            $role->syncPermissions($permission);
        }
        $role = Role::create(['name' => 'Admin Super']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $roles = [
            'Ketua',
            'Wakil Ketua I',
            'Wakil Ketua II',
            'Wakil Ketua III',
            'Wakil Ketua IV',
            'Sekretaris',
            'Sekretaris I',
            'Sekretaris II',
            'Sekretaris III',
            'Ketua Bidang Organisasi',
            'Ketua Bidang Advokasi dan Kemitraan',
            'Badan Hukum Pembinaan dan Pembelaan Anggota',
            'Ketua Bidang Pendidikan, Ilmiah dan Pelayanan Kedokteran',
            'Bidang P2KB',
            'Badin',
            'Ketua Bidang JKN',
            'Ketua Bidang Inovasi dan Kewirausahaan',
            'Ketua Bidang Kesejahteraan',
            'Ketua Bidang Pengabdian Profesi dan Tanggap Bencana',
            'Ketua Bidang Pelayanan Kesehatan',
            'Ketua Bidang Humas dan Media Sosial',
        ];
        foreach ($roles as $item) {
            $role = Role::create(['name' => $item]);
        }
    }
}
