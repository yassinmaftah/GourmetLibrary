<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $culinaryCategories = ['Pâtisserie Française', 'Cuisine du Monde', 'Sans Gluten', 'Cuisine Marocaine', 'Boulangerie', 'Végétarien'];

        return [
            'name' => $this->faker->unique()->randomElement($culinaryCategories),
            'description' => $this->faker->sentence(),
        ];
    }
}
