<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('+1 days', '+10 days');
        $end = $this->faker->dateTimeBetween($start, '+5 days');

        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'country' => $this->faker->country,
            'capacity' => $this->faker->numberBetween(10, 500),
            'start_time' => $start,
            'end_time' => $end,
        ];
    }
}
