<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrayValues = ['active', 'reject'];

        return [
            'permission_name' => $this->faker->name(),
            'status' => $arrayValues[rand(0,2)],
        ];
    }
}
