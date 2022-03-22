<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TruckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'name' => $this->faker->name(),
            'brand' => $this->faker->randomElement(array('Isuzo', 'Dongfeng', 'Sinotruk', 'JAC')),
            'model' => $this->faker->bothify("##-???#"),
            'plate_no' => $this->faker->bothify("###-????"),
            'owner' => $this->faker->name(),
            'status' => $this->faker->randomElement(array('', 'In-service', 'Maintenance')),
            'description' => $this->faker->sentence,
        ];
    }
}
