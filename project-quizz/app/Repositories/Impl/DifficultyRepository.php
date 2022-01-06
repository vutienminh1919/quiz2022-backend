<?php

namespace App\Repositories\Impl;

use App\Models\Difficulty;
use App\Repositories\DifficultyRepositoryImp;
use App\Repositories\Eloquent\EloquentRepository;

class DifficultyRepository extends EloquentRepository implements DifficultyRepositoryImp
{
    public function getModel()
    {
        return Difficulty::class;
    }
}
