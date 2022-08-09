<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sub_category_id' => SubCategoryFactory::factory()->create(),
            'list_position' => $this->faker->randomDigit(),
            'home_view' => $this->faker->randomDigit(),
        ];
    }
}
