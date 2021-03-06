<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question_content' => $this->faker->realText(rand(100,1000),1),
            'difficulty' => $this->faker->numberBetween(1,3),
            'category_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
