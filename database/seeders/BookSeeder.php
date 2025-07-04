<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Get authors
        $jkRowling = Author::where('name', 'J.K. Rowling')->first();
        $grrMartin = Author::where('name', 'George R.R. Martin')->first();
        $agathaChristie = Author::where('name', 'Agatha Christie')->first();
        $stephenKing = Author::where('name', 'Stephen King')->first();
        $janeAusten = Author::where('name', 'Jane Austen')->first();

        // Get genres
        $fantasy = Genre::where('name', 'Fantasy')->first();
        $mystery = Genre::where('name', 'Mystery')->first();
        $romance = Genre::where('name', 'Romance')->first();
        $horror = Genre::where('name', 'Horror')->first();
        $classic = Genre::where('name', 'Classic Literature')->first();
        $youngAdult = Genre::where('name', 'Young Adult')->first();
        $adventure = Genre::where('name', 'Adventure')->first();

        $books = [
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'author_id' => $jkRowling->id,
                'genres' => [$fantasy, $youngAdult, $adventure],
            ],
            [
                'title' => 'A Game of Thrones',
                'author_id' => $grrMartin->id,
                'genres' => [$fantasy, $adventure],
            ],
            [
                'title' => 'Murder on the Orient Express',
                'author_id' => $agathaChristie->id,
                'genres' => [$mystery, $classic],
            ],
            [
                'title' => 'The Shining',
                'author_id' => $stephenKing->id,
                'genres' => [$horror],
            ],
            [
                'title' => 'Pride and Prejudice',
                'author_id' => $janeAusten->id,
                'genres' => [$romance, $classic],
            ],
        ];

        foreach ($books as $bookData) {
            $genres = $bookData['genres'];
            unset($bookData['genres']);
            
            $book = Book::create($bookData);
            
            // Attach genres to the book
            $book->genres()->attach($genres);
        }
    }
}
