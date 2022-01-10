<?php

namespace App\Repositories;

use App\Models\Question;
use App\Repositories\Eloquent\EloquentRepo;
use Illuminate\Support\Facades\DB;

class QuestionRepo extends EloquentRepo implements CRUDinterfaceRepo
{
    public function getAll()
    {
        return $this->model->with('category', 'answers')->get();
    }

    public function findById($id){
        return $this->model->with('answers')->find($id);
    }

    public function getModel()
    {
        return Question::class;
    }
    public function getQuestionsByCategoryId($category_id)
    {
        return Question::where('category_id',$category_id)->get();
    }
    public function latest()
    {
        return DB::table('questions')->latest('id')->first();
    }
}
