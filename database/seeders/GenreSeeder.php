<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run()
    {
        DB::table('genres')->insert([
            ['name' => 'Fiction', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mystery', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Romance', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Science Fiction', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fantasy', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Historical Fiction', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dystopian', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Classic Literature', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}