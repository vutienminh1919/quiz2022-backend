<?php

namespace App\Repositories;



use App\Models\Category;
use App\Models\Question;
use App\Models\Quiz;
use App\Repositories\Eloquent\EloquentRepo;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;

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

    public function findById($id)
    {
        return $this->model->with('questions')->find($id);
    }

    public function getAllQuestion()
    {
        $questions = Question::class;
        return $questions->all();
    }

    public function latest()
    {
        return DB::table('quizzes')->latest('id')->first();
    }
}
