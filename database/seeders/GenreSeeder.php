<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run()
    {
        $genres = [
            ['name' => 'Fantasy'],
            ['name' => 'Mystery'],
            ['name' => 'Romance'],
            ['name' => 'Science Fiction'],
            ['name' => 'Horror'],
            ['name' => 'Historical Fiction'],
            ['name' => 'Adventure'],
            ['name' => 'Young Adult'],
            ['name' => 'Classic Literature'],
            ['name' => 'Thriller'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
