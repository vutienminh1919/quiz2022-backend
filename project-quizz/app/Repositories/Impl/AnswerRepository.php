<?php

namespace App\Repositories\Impl;

use App\Models\Answer;
use App\Repositories\AnswerRepositoryImp;
use App\Repositories\Eloquent\EloquentRepository;

class AnswerRepository extends EloquentRepository implements AnswerRepositoryImp
{
    public function getModel()
    {
        return Answer::class;
    }
}
