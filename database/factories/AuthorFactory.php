<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'biography' => $this->faker->optional(0.7)->paragraph(3),
            'birth_date' => $this->faker->optional(0.8)->date('Y-m-d', '-20 years'),
            'nationality' => $this->faker->optional(0.6)->country,
        ];
    }
}
