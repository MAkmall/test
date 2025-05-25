<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambah user admin (contoh)
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'), // Jangan simpan password dalam bentuk plain text!
            'role'=> 'admin'
        ]);

        // Menambah user lainnya jika perlu
        User::create([
            'name' => 'User1',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'peserta'
        ]);
    }
}
