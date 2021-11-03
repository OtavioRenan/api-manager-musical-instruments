<?php

namespace Database\Factories;

use App\Models\MarkModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarkModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MarkModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mark_id' => 1,
            'mark_name' => $this->faker->name(),
            'mark_slug' => $this->faker->slug(),
        ];
    }
}
