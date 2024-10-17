<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BreakTimeFactory extends Factory
{
    public function definition()
    {
        $dammyDate = $this->faker->dateTimeBetween('2024-08-24 11:00:00', '2024-08-24 13:00:00');
        return [
            'work_id' => $this->faker->numberBetween(18,52),
            'break_start' => $dammyDate->format('Y-m-d H:i:s'),
            'break_end' => $dammyDate->modify('+30 minutes')->format('Y-m-d H:i:s'),
        ];
    }
}
