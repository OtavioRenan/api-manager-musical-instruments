<?php

namespace Database\Factories;

use App\Models\InstrumentTypeModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstrumentTypeModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InstrumentTypeModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'inst_typ_name' => $this->faker->name(),
            'inst_typ_slug' => $this->faker->slug(),
        ];
    }
}
