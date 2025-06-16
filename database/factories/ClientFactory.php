<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
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
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'city' => $this->faker->city(),
            'state' => $this->faker->word(),
            'street' => $this->faker->streetAddress(),
            'neighborhood' => $this->faker->word(),
            'number' => $this->faker->randomNumber(),
            'cep' => $this->faker->randomNumber(),
            'country' => "Brasil",
        ];
    }
}
