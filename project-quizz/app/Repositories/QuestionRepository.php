<?php

namespace App\Repositories;

use App\Models\Question;

class QuestionRepository implements Repository
{
    public function getAll(){
        $questions = Question::all();
        return $questions;
    }

    public function findById($id) {
        $question = Question::findOrFail($id);
        return $question;
    }

    public function create($data) {
        $question = Question::create($data);
        return $question;
    }

    public function update($data, $object) {
        $question = Question::findOrFail($object);
        $question->name = $data->name;
        $question->category_id = $data->category_id;
        $question->difficulty_id = $data->difficulty_id;
        $question->save();
    }

    public function destroy($object) {
        $question = Question::findOrFail($object);
        $question->delete();
    }
}
