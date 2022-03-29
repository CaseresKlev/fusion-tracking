<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       \App\Models\Driver::factory(100)->create();
       \App\Models\User::factory(10)->create();
       \App\Models\Company::factory(30)->create();
       \App\Models\Truck::factory(50)->create();
       
       //php atisan db:seed
    }
}
