<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class NotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notes')->insert([
            [
                'title' => Str::random(10),
                'description' => Str::random(10)." [Bold]".Str::random(10)."[/Bold]",
                'author' => 1,
                'category' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => Str::random(10),
                'description' => "[Italic]".Str::random(10)."[/Italic] ".Str::random(4),
                'author' => 1,
                'category' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => Str::random(10),
                'description' => Str::random(10)." [Underline]".Str::random(4)."[/Underline]",
                'author' => null,
                'category' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => Str::random(15),
                'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse et tincidunt nibh. Sed at feugiat massa. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.",
                'author' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
