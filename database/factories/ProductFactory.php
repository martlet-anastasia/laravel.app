<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'price' => $this->faker->randomNumber(3),
            'img' => $this->faker->imageUrl(600, 600),
            'status' => $this->faker->boolean(),
            'content' => $this->faker->realTextBetween(100, 200)
        ];
    }
}
