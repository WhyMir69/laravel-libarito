<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Book;
use App\Models\User;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        // Get books
        $books = Book::all();

        $sampleReviews = [
            [
                'content' => 'An absolutely magical story that captivated me from the first page.',
                'rating' => 5,
            ],
            [
                'content' => 'A gripping tale with complex characters and an intricate plot.',
                'rating' => 4,
            ],
            [
                'content' => 'Classic mystery at its finest. Agatha Christie never disappoints.',
                'rating' => 5,
            ],
            [
                'content' => 'Terrifyingly good! Stephen King knows how to create atmosphere.',
                'rating' => 4,
            ],
            [
                'content' => 'A timeless romance that never gets old. Beautiful writing.',
                'rating' => 5,
            ],
        ];

        foreach ($books as $index => $book) {
            if (isset($sampleReviews[$index])) {
                $reviewData = $sampleReviews[$index];
                $reviewData['book_id'] = $book->id;
                Review::create($reviewData);
            }
        }

        // Add some additional random reviews
        foreach ($books as $book) {
            // Add 1-2 more reviews per book
            $additionalReviews = rand(1, 2);
            for ($i = 0; $i < $additionalReviews; $i++) {
                Review::create([
                    'content' => 'This is a sample review for ' . $book->title . '. Great read!',
                    'rating' => rand(3, 5),
                    'book_id' => $book->id,
                ]);
            }
        }
    }
}
