<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'user',
                'password' => Hash::make('user'), // Menggunakan bcrypt untuk hashing password
            ],
            // [
            //     'username' => 'user2',
            //     'password' => Hash::make('password2'),
            // ],
            // [
            //     'username' => 'user3',
            //     'password' => Hash::make('password3'),
            // ],
        ]);
    }
}
