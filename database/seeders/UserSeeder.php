<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Hash; // Import Hash facade untuk enkripsi password

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@gmail.com', // Kunci untuk mencari user
            ],
            [
                'name' => 'Administrator',
                'password' => Hash::make('12345678'), // Password default, WAJIB diubah setelah login pertama kali
                'email_verified_at' => now(), // Anggap email sudah terverifikasi
            ]
        );
    }
}
