<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('users')->insert([
              [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('User@123456'),
                'admin_profile' => '0',
                'email_verified_at' => date('y-m-d h:i:s')
            ], [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Admin@123456'),
                'admin_profile' => '1',
                'email_verified_at' => date('y-m-d h:i:s')
              ]
            ]);
    }
}
