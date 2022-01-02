<?php

namespace Database\Seeders;

use App\Http\Controllers\Setting\RoleController;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = new RoleController;
        $roles->seed();
    }
}
