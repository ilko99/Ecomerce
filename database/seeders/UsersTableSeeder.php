<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('users')->insert([
            // for Admin user
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@abv.bg',
            'password' => Hash::make('111'),
            'role' => 'admin',
            'status' => 'active',
        ],
        [
            // for Vendor user
            'name' => 'Vendor',
            'username' => 'vendor',
            'email' => 'vendor@abv.bg',
            'password' => Hash::make('111'),
            'role' => 'vendor',
            'status' => 'active',
        ],
        [
            // for user
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@abv.bg',
            'password' => Hash::make('111'),
            'role' => 'user',
            'status' => 'active',
        ]);
    }
}
