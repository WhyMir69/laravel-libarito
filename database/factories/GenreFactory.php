<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class GenreFactory extends Factory
{
    protected $model = Genre::class;

    public function definition()
    {
        $genres = [
            'Fiction',
            'Non-Fiction',
            'Mystery',
            'Thriller',
            'Romance',
            'Fantasy',
            'Science Fiction',
            'Biography',
            'History',
            'Horror',
            'Adventure',
            'Drama',
            'Comedy',
            'Poetry',
            'Philosophy',
            'Psychology',
            'Self-Help',
            'Travel',
            'Cooking',
            'Art',
            'Music',
            'Sports',
            'Technology',
            'Business',
            'Health'
        ];

        return [
            'name' => $this->faker->unique()->randomElement($genres),
        ];
    }
}
