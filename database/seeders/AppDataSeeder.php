<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AppDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('app_data')->insert([
            'name' => 'Tokoku',
            'logo' => 'logo.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
