<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'address'=> $this->faker->address,
            'contact_no' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'description' => $this ->faker->sentence,
        ];
    }
}
