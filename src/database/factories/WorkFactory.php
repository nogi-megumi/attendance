<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class WorkFactory extends Factory
{
    public function definition()
    {
        $dammyDate = $this->faker->dateTimeBetween('2024-08-24 09:00:00', '2024-08-24 10:00:00');
        return [
            'user_id' => User::factory(),
            'work_start' => $dammyDate->format('Y-m-d H:i:s'),
            'work_end' => $dammyDate->modify('+6hours')->format('Y-m-d H:i:s'),
        ];
    }
}
