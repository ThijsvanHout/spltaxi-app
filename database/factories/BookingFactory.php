<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
			'company' => $this->fakercompany,
            'pickup_address' => $this->faker->address,
            'no_of_persons' => $this->faker->numberBetween(1, 6),
            'pickup_date' => $this->faker->date(),
            'pickup_time' => $this->faker->time(),
            'destination' => $this->faker->address,
            'return_flight' => $this->faker->randomElement(['yes', 'no']),
            'flight_no_on_return' => $this->faker->randomNumber(),
            'date_return_flight' => $this->faker->date(),
            'optional_comment' => $this->faker->sentence,
        ];
    }
}
