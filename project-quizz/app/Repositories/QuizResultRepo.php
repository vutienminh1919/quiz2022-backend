<?php

namespace App\Repositories;

use App\Models\QuizResult;
use App\Repositories\Eloquent\EloquentRepo;

class QuizResultRepo extends EloquentRepo implements CRUDinterfaceRepo
{
    public function getModel()
    {
        return QuizResult::class;
    }
}
