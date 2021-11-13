<?php

namespace Database\Factories;

use App\Models\ModelYearModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModelYearModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ModelYearModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mode_yea_id' => $this->faker->randomDigitNotNull(),
            'mode_yea_launch' => $this->faker->date(),
            'mode_yea_end_of_production' => $this->faker->date(),
        ];
    }
}
