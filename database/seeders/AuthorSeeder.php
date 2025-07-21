<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        DB::table('authors')->insert([
            [
                'name' => 'J.K. Rowling',
                'biography' => 'British author, best known for the Harry Potter series.',
                'birth_date' => '1965-07-31',
                'nationality' => 'British',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'George R.R. Martin',
                'biography' => 'American novelist and short story writer, best known for A Song of Ice and Fire series.',
                'birth_date' => '1948-09-20',
                'nationality' => 'American',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Agatha Christie',
                'biography' => 'English writer known for her detective novels featuring Hercule Poirot and Miss Marple.',
                'birth_date' => '1890-09-15',
                'nationality' => 'British',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Stephen King',
                'biography' => 'American author of horror, supernatural fiction, suspense, and fantasy novels.',
                'birth_date' => '1947-09-21',
                'nationality' => 'American',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Austen',
                'biography' => 'English novelist known for her social commentary and wit in novels like Pride and Prejudice.',
                'birth_date' => '1775-12-16',
                'nationality' => 'British',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}