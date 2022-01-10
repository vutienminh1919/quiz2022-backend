<?php

namespace App\Repositories;



use App\Models\Category;
use App\Models\Quiz;
use App\Repositories\Eloquent\EloquentRepo;
use Illuminate\Support\Facades\DB;

class QuizRepo extends EloquentRepo implements CRUDinterfaceRepo
{
    public function getAll()
    {
        return $this->model->with('questions')->get();
    }
    public function getModel()
    {
        return Quiz::class;
    }

    public function latest()
    {
        return DB::table('quizzes')->latest('id')->first();
    }
}
