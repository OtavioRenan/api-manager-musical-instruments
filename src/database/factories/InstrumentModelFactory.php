<?php

namespace Database\Factories;

use App\Models\InstrumentModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstrumentModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InstrumentModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'inst_id' => $this->faker->randomDigitNotNull(),
            'inst_name' => $this->faker->name(),
            'inst_slug' => $this->faker->slug(),
            'inst_description' => $this->faker->name(),
        ];
    }
}
