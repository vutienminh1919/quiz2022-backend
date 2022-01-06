<?php

namespace App\Repositories\Impl;

use App\Models\Test;
use App\Repositories\TestRepositoryImpl;
use App\Repositories\Eloquent\EloquentRepository;

class TestRepository extends EloquentRepository implements TestRepositoryImpl
{

    public function getModel()
    {
        return Test::class;
    }

    public function getAll()
    {
        return $this->model->with("questions")->get();
    }
}
