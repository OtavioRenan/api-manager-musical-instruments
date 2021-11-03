<?php

namespace Database\Factories;

use App\Models\ModelModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModelModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ModelModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mode_id' => 1,
            'mode_name' => $this->faker->name(),
            'mode_slug' => $this->faker->slug(),
        ];
    }
}
