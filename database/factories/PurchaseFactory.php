<?php

namespace Database\Factories;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id,
            'original_price'=> rand(1,100),
            'sale_price'=> rand(1,100),
            'quantity'=> rand(1,100),
            'purchased_at'=> fake()->date(),
            'expired_at'=> fake()->date(),

           
       ];
    }
}
