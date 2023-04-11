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
            // 'name' => fake()->name(),
            // 'email' => fake()->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'remember_token' => Str::random(10),

            // 'user_id' => 1,
            // 'product_name' => fake()->word(),
            // 'image' => fake()->imageUrl(),
            // 'status' => fake()->randomElement(['School Supply', 'Others', 'Printing']),
            // 'price' => fake()->randomFloat(2, 1, 100),
            // 'quantity' => fake()->numberBetween(1, 100),
            // 'category_id' => fake()->numberBetween(1, 5),
           
        ];
    }
}
