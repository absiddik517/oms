<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Office>
 */
class OfficeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'office_name' => json_encode([
                'bn' => $this->faker->unique()->company(),
                'en' => $this->faker->unique()->company(),
            ]),
            'upazila' => json_encode([
                'bn' => $this->faker->city(),
                'en' => $this->faker->city(),
            ]),
            'district' => json_encode([
                'bn' => $this->faker->state(),
                'en' => $this->faker->state(),
            ]),
            'geo_code' => $this->faker->numberBetween(6100, 6199),
            'office_code' => $this->faker->numberBetween(1240303142000, 1240303142999),
        ];
    }
}
