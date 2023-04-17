<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Providers\BrazilianCarPlateProvider;

class VehicleFactory extends Factory
{
    public function definition(): array
    {
        $faker = $this->faker;
        $faker->addProvider(new BrazilianCarPlateProvider($faker));
        return [
            'plate_number' => $faker->carPlate,
        ];
    }
}
