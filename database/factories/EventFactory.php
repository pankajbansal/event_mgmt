<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        $start = $this->faker->dateTimeBetween('+1 day', '+2 days');
        $end = $this->faker->dateTimeBetween($start->format('Y-m-d H:i:s'), '+5 days');

        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'country' => $this->faker->country,
            'capacity' => $this->faker->numberBetween(1, 100),
            'start_time' => $start,
            'end_time' => $end,
        ];
    }
}
