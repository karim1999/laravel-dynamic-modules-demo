<?php

namespace Database\Factories;

use App\Models\Field;
use Illuminate\Database\Eloquent\Factories\Factory;

class FieldFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Field::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name"=> $this->faker->unique()->word,
            "label"=> $this->faker->word,
            "type"=> $this->faker->randomElement(["lookup", "text", "email", "number", "select", "date", "time", "datetime"]),
        ];
    }
}
