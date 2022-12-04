<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
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
            'job_name' => $this->faker->name(),
            'username' => $arrayValues[rand(0,2)],
        ];
    }
}
