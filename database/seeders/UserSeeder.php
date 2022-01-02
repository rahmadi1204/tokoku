<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
            [
                'name' => 'super admin',
                'gender' => 'l',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name' => 'admin',
                'gender' => 'l',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        DB::table('users')->insert([
            [
                'name' => 'super admin',
                'username' => 'super.admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
