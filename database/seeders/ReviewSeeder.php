<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Book;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $bookIds = Book::pluck('id')->toArray();

        if (empty($bookIds)) {
            $this->command->warn('No books found, skipping reviews.');
            return;
        }

        DB::table('reviews')->insert([
            [
                'book_id' => $bookIds[array_rand($bookIds)],
                'content' => 'Absolutely magical! A wonderful start to the series.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_id' => $bookIds[array_rand($bookIds)],
                'content' => 'Great book for all ages. Really enjoyed reading it.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_id' => $bookIds[array_rand($bookIds)],
                'content' => 'Epic fantasy with incredible world-building.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_id' => $bookIds[array_rand($bookIds)],
                'content' => 'Classic mystery with a brilliant plot twist.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_id' => $bookIds[array_rand($bookIds)],
                'content' => 'Terrifying and brilliantly written horror novel.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_id' => $bookIds[array_rand($bookIds)],
                'content' => 'Timeless romance with witty dialogue.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_id' => $bookIds[array_rand($bookIds)],
                'content' => 'Complex characters and intricate plot lines.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_id' => $bookIds[array_rand($bookIds)],
                'content' => 'Perfect introduction to the wizarding world.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
