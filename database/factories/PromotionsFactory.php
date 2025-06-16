<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promotions>
 */
class PromotionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'details' => $this->faker->word(),
            'price' => $this->faker->randomNumber(),
            'porcentage' => $this->faker->numberBetween(0, 100),
            'client_id' => 1,
            'product_id' => 1,
        ];
    }
}
