<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@waroeng.com',
            'password' => Hash::make('superadmin123'),
            'role' => 'superadmin',
        ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin@waroeng.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}
