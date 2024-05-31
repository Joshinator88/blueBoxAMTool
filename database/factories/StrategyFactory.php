<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Strategy>
 */
class StrategyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "title" => "title: " . fake()->sentence(),
            'summary' => "summary: " . fake()->sentence(),
            'today' => "today: " . fake()->sentence(),
            'tomorrow' => "tomorow: " . fake()->sentence(),
            'how' => "how: " . fake()->sentence(),
            'alignment' => "alignment: " . fake()->sentence(),
        ];
    }
}
