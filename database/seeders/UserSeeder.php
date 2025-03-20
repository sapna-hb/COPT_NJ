<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'role_id' => 1,
                'name' => 'Administrator',
                'phone' => '9876543210',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'is_active' => 1,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
