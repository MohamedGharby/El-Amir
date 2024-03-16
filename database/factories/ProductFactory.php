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
            'name'=>fake('ar')->company(),
            'code' => $this->faker->isbn13(),
            'desc' => fake('ar')->text(),
            'color' => fake('ar')->colorName(),
            'dimension'=> $this->faker->randomElement(['2','5','7']),
            'cc' => $this->faker->randomElement(['200','500']),
            'weight' => $this->faker->randomFloat(true,3,2),
            'price' => $this->faker->randomFloat(true,6,2),
            'percentage' => 0.20,
            'img' => 'image.jpg'
        ];
    }
}
