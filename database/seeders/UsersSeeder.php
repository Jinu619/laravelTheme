<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ginu',
            'username' => 'admin',
            'email' => 'jinu@gmail.com',
            'phone' => '9998887776',
            'usertype' => 'superadmin',
            'password' => Hash::make('admin@123'),
        ]);
    }
}
