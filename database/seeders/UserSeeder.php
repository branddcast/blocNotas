<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "name" => 'Admin', 
            "email" => 'admin@demo.mx',
            "password" => bcrypt("4DM1N1STR4D0R*"),
            "created_at" => now(),
            "updated_at" => now()
        ]);
    }
}
