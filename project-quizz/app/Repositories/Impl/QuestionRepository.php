<?php

namespace App\Repositories\Impl;

use App\Models\Question;
use App\Repositories\Eloquent\EloquentRepository;
use App\Repositories\QuestionRepositoryImp;

class QuestionRepository extends EloquentRepository implements QuestionRepositoryImp
{
    public function getModel()
    {
        return Question::class;
    }
}
