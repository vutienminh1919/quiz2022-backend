<?php

use App\Models\Answer;
use Illuminate\Http\Client\Request;

class AnswerRepository
{
    public function getAll()
    {
        $answer = Answer::all();
        return $answer;
    }

    public function getById($id)
    {
        $answer = Answer::findOrFail($id);
        return $answer;

    }

    public function update(Request $request, $id)
    {
        $answer = Answer::findOrFail($id);
        $answer->question_id = $request->input('question_id');
        $answer->option = $request->input('option');
        $answer->correct = $request->input('correct');
        $answer->save();
    }

    public function destroy($id)
    {
        $answer = Answer::findOrFail($id);
        $answer->delete();

    }

}
