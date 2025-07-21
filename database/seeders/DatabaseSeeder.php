<?php

namespace Database\Seeders;

<<<<<<< HEAD
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProductSeeder::class,
        ]);
    }
}
=======
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create additional users
        User::factory(10)->create();

        // Create genres first (predefined list to avoid duplicates)
        $genreNames = [
            'Fiction', 'Non-Fiction', 'Mystery', 'Thriller', 'Romance', 
            'Fantasy', 'Science Fiction', 'Biography', 'History', 'Horror',
            'Adventure', 'Drama', 'Poetry', 'Philosophy', 'Self-Help'
        ];

        $genres = collect($genreNames)->map(function ($name) {
            return Genre::firstOrCreate(['name' => $name]);
        });

        // Create authors with books
        Author::factory(25)->create()->each(function ($author) use ($genres) {
            // Each author writes between 1 to 5 books
            $bookCount = fake()->numberBetween(1, 5);
            
            for ($i = 0; $i < $bookCount; $i++) {
                $book = Book::factory()->create(['author_id' => $author->id]);
                
                // Attach 1-3 random genres to each book
                $randomGenres = $genres->random(fake()->numberBetween(1, 3));
                $book->genres()->attach($randomGenres->pluck('id'));
                
                // Create 0-8 reviews for each book
                $reviewCount = fake()->numberBetween(0, 8);
                if ($reviewCount > 0) {
                    Review::factory($reviewCount)->create(['book_id' => $book->id]);
                }
            }
        });

        $this->command->info('Library seeded with:');
        $this->command->info('- ' . Author::count() . ' authors');
        $this->command->info('- ' . Book::count() . ' books');
        $this->command->info('- ' . Genre::count() . ' genres');
        $this->command->info('- ' . Review::count() . ' reviews');
        $this->command->info('- ' . User::count() . ' users');
    }
}
>>>>>>> 4db59ba1938de0e418ef7c0900ff3dbdfa47e0ec
