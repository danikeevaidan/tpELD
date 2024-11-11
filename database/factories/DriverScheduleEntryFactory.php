<?php

namespace Database\Factories;

use App\Models\DriverScheduleEntry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DriverScheduleEntry>
 */
class DriverScheduleEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'driver_id' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(DriverScheduleEntry::STATUSES),
            'latitude' => $this->faker->randomFloat(5, -90, 90),
            'longitude' => $this->faker->randomFloat(5, -180, 180),
            'description' => $this->faker->randomElement([$this->faker->paragraph(), null, null])
        ];
    }
}
