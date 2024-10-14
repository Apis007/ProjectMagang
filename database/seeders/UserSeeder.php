<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan Anda menggunakan model User

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'your_username',
            'password' => bcrypt('your_password'), // Menggunakan Bcrypt
        ]);
    }
}
