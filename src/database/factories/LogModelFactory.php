<?php

namespace Database\Factories;

use App\Models\LogModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LogModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'logs_id' => 1,
            'system_logable_id' => $this->faker->randomDigitNotNull,
            'system_logable_type' => $this->faker->name,
            'user_id '=> $this->faker->randomDigitNotNull,
            'guard_name' => $this->faker->name,
            'action' => $this->faker->name,
            'old_value' => null,
            'new_value' => null,
            'ip_address' => $this->faker->ip,
        ];
    }
}
