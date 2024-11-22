<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(2),
            'price' => $this->faker->randomNumber(),
            'quantity' => $this->faker->randomNumber(),
            'image' => $this->faker->imageUrl(),
            'is_active' => $this->faker->boolean(),
            'category_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
