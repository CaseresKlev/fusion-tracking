<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName(),
            'middlename'=> $this->faker->lastName(),
            'lastname' => $this->faker->lastName(),
            'address' => $this->faker->address(),
            'contact_no' => $this->faker->phoneNumber(),
            'position' => $this->faker->randomElement(array('','Driver', 'Helper')),
            'trip_status' =>$this->faker->randomElement(array('', 'On Trip'))
        ];
    }
}
