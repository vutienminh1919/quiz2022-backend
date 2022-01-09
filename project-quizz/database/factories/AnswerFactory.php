<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'answer_content' => $this->faker->realText(rand(20,100),rand(1,2)),
            'question_id' => $this->faker->numberBetween(1,200),
            'correct' => $this->faker->numberBetween(0,1),
        ];
    }
}
