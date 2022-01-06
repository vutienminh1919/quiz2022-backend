<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answer = new Answer([
            'option' => 'a',
            'question_id' => 1,
            'correct' => 1
        ],
        );
        $answer->save();

        $answer = new Answer([
            'option' => 'b',
            'question_id' => 1,
        ],
        );
        $answer->save();

        $answer = new Answer([
            'option' => 'c',
            'question_id' => 1,
        ],
        );
        $answer->save();

        $answer = new Answer([
            'option' => 'd',
            'question_id' => 1,
        ],
        );
        $answer->save();

    }
}
