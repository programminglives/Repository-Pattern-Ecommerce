<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'full_name' => 'admin',
                'email' => 'admin@admin.com',
                'phone_number' => '9866268438',
                'password' => Hash::make('password'),
                'remember_token' => '789456',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
