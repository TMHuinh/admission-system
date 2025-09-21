<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'application_id' => 'APP-' . date('Y') . '-' . $this->faker->unique()->numerify('####'),
            'applicant_name' => $this->faker->name(),
            'programme' => $this->faker->randomElement(['IT', 'SE', 'BA']),
            'intake' => $this->faker->year(),
            'status' => $this->faker->randomElement(['submitted', 'accepted', 'rejected']),
            'payment_status' => $this->faker->randomElement(['unpaid', 'partial', 'paid']),
        ];
    }
}
