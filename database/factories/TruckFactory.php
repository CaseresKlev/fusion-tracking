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
            'plate_no' => $this->faker->bothify('???-###'),
            'Brand' => $this->faker->randomElements(['HINO', 'ISUZO', 'CHAVDAR', 'AVIA TRUCKS', 'ELVO']),
            'model' => $this->faker->bothify('??-#####'),
            'status' =>  $this->faker->randomElements(['', 'In-Service', 'Maintenance']),
            'description' => $this->faker->paragraph(),
        ];
    }
}
