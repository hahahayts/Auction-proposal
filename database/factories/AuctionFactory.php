<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auction>
 */
class AuctionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title' => $this->faker->sentence(),

            'description' => $this->faker->paragraph(),
            'imageURL' => 'https://s.alicdn.com/@sc04/kf/Ha3b8edbafe9c4b348ea132bebc538c8bt.png_720x720q50.jpg',
            'category_id' => rand(1,5),
            'start_price' => $this->faker->randomFloat(2, 1, 1000),
            'start_time' => $this->faker->dateTimeBetween('now', '+1 week'),
            'status' => $this->faker->randomElement(['ongoing', 'upcoming', 'closed']),
            'end_time' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
        ];

        return [
            //
        ];
    }
}
