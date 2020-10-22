<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'title' => "Viajes",
                'description' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => "Comidas",
                'description' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => "Trabajo",
                'description' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
