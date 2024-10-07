<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->name(),
            'hinh_anh'=>fake()->imageUrl(),
            'status'=>fake()->boolean(80),
            'start_date'=>fake()->dateTimeBetween('-1 month','now'),
            'end_date'=>fake()->dateTimeBetween('now','+1 month')
        ];
    }
}
