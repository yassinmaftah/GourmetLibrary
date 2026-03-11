<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $totalCopies = $this->faker->numberBetween(1, 5);

        return [
            'category_id' => \App\Models\Category::factory(),
            'title' => 'Recettes de ' . $this->faker->words(2, true),
            'author' => 'Chef ' . $this->faker->lastName(),
            'isbn' => $this->faker->unique()->isbn13(),
            'total_copies' => $totalCopies,
            'available_copies' => $totalCopies,
            'published_at' => $this->faker->date(),
            'cover_image' => $this->faker->imageUrl(400, 600, 'food'),
        ];
    }
}
