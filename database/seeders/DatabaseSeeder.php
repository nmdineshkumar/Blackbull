<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('adminusers')->insert([
            'first_name' => 'Admin',
            'last_name' => '',
            'email' => 'admin@blackbull.com', 
            'password' => bcrypt('Admin@123'),
            'display_name'=>'Super Admin',
            'phone_number' => '9789362363'
        ]);
    }
}
