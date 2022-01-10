<?php

namespace App\Repositories;

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
        return QuizQuestion::where('quiz_id', $id)->get();
    }
}
