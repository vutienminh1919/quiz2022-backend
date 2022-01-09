<?php

namespace App\Repositories;

use App\Models\Answer;
use App\Repositories\Eloquent\EloquentRepo;

class AnswerRepo extends EloquentRepo implements CRUDinterfaceRepo
{
    public function getModel()
    {
        return Answer::class;
    }

    public function getAnswerByQuestionId($question_id)
    {
        return Answer::where('question_id',$question_id)->get();
    }
}
