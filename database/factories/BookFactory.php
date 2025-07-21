<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        $bookTitles = [
            'The Midnight Chronicles',
            'Echoes of Tomorrow',
            'The Last Garden',
            'Whispers in the Dark',
            'Beyond the Horizon',
            'The Crystal Tower',
            'Shadows of the Past',
            'The Golden Thread',
            'Rivers of Time',
            'The Silent Revolution',
            'Dancing with Ghosts',
            'The Forgotten Kingdom',
            'Beneath the Stars',
            'The Iron Will',
            'Secrets of the Ancient',
            'The Broken Mirror',
            'Tales from the Edge',
            'The Crimson Dawn',
            'Voices in the Wind',
            'The Emerald City'
        ];

        return [
            'title' => $this->faker->randomElement($bookTitles) . ': ' . $this->faker->words(2, true),
            'author_id' => Author::factory(),
        ];
    }
}
