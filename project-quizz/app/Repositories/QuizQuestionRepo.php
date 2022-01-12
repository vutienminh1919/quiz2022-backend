<?php

namespace App\Repositories;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Repositories\Eloquent\EloquentRepo;

class QuizQuestionRepo extends EloquentRepo implements CRUDinterfaceRepo
{
    public function getModel()
    {
        return QuizQuestion::class;
    }
    public function getQuestionsByQuizId($id)
    {
        $quiz = Quiz::find($id)->with('questions.answers')->get();
        return $quiz;
    }
}
