<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
    $cost = fake()->numberBetween(100, 5000);

    return [
        'name'            => fake()->unique()->words(3, true),
        'sku'             => strtoupper(fake()->unique()->bothify('SKU-####-??')),
        'price'           => $cost + fake()->numberBetween(50, 1500),
        'cost_price'      => $cost,
        'quantity'        => fake()->numberBetween(0, 100),
        'low_stock_limit' => 10,
        'description'     => fake()->sentence(12),
        // category_id, brand_id, supplier_id seeder mein set honge
    ];
}
}
