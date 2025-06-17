<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Display>
 */
class DisplayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $types = ['indoor', 'outdoor'];

        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price_per_day' => $this->faker->randomFloat(2, 10, 1000),
            'resolution_height' => $this->faker->numberBetween(720, 2160),
            'resolution_width' => $this->faker->numberBetween(1280, 3840),
            'type' => $this->faker->randomElement($types),
            'user_id' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
