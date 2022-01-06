<?php

namespace App\Repositories;

use App\Models\Answer;
use App\Models\Question;

class QuestionRepository implements Repository
{

    public function getAll()
    {
        $question = Question::all();
        return $question;
    }

    public function getById($id)
    {
       return $question = Question::findOrFail($id);
    }

    public function store($request)
    {
        $testID = $request->input('test');
        $questionName = $request->input('question');
        $optionArray[] = $request->input('options');
        $correctOptions[] = $request->input('correct');

        $question = new Question();
        $question->test_id = $testID;
        $question->question_name = $questionName;
        $question->save();

        $questionToAdd = Question::latest()->first();;
        $questionID = $questionToAdd->id;

        foreach ($optionArray as $index => $opt) {
            $option = new Answer();
            $option->question_id = $questionID;
            $option->option = $opt;
            foreach ($correctOptions as $correctOption) {
                if($correctOption == $index+1) {
                    $option->correct = 1;
                }
            }
            $option->save();
        }
        return $question;
    }

    public function update($id, $request)
    {
        $testID = $request->input('test');
        $questionName = $request->input('question');

        $question = Question::find($id);
        $question->test_id = $testID;
        $question->question_name = $questionName;
        $question->save();
        return $question;
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
    }
}
