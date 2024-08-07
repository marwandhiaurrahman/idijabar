<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            "name" => "Marwan Dhiaur Rahman",
            "username" => "marwan",
            "email" => "marwandhiaurrahman@gmail.com",
            "phone" => "089529909036",
            'password' => bcrypt('qweqweqwe'),
            'email_verified_at' => now(),
        ]);
    }
}
