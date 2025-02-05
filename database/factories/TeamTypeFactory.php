<?php

namespace Database\Factories;

use App\Models\TeamType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeamType>
 */
class TeamTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'       => $this->faker->word,
            'description' => $this->faker->text(200), // Mô tả team type, faker text 200 ký tự
        ];
    }
}
