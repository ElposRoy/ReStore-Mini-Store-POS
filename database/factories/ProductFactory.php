<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          
            'user_id' => 1,
            'product_name' => fake()->word(),
            'image' => fake()->imageUrl(),
            'stock_level' => fake()->numberBetween(1, 100),
            'unit' => fake()->numberBetween(1, 100),
          
            'unit_type_id' => fake()->numberBetween(1, 5),
            'category_id' => fake()->numberBetween(1, 5),
           
        ];
    }
}
