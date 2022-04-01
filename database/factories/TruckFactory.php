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
            'company_id' => $this->faker->randomElement(array('1', '2', '3')),
            'owner' => $this->faker->name(),
            'status' => $this->faker->string(),
            'description' => $this->faker->sentence,
        ];
    }
}
