<?php

namespace App\Repositories;

use App\Models\UserQuiz;
use App\Repositories\Eloquent\EloquentRepo;

class UserQuizRepo extends EloquentRepo implements CRUDinterfaceRepo
{
    public function getModel()
    {
        return UserQuiz::class;
    }
}
