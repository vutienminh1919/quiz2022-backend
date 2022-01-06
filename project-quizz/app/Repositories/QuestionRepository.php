<?php

namespace App\Repositories;

use App\Models\Question;

class QuestionRepository implements Repository
{

    public function getAll()
    {
        $question = Question::all();
    }

    public function getById($id)
    {
       return $question = Question::findOrFail($id);
    }

    public function store($request)
    {
        $topicID = $request->input('topic');
        $questionText = $request->input('question');
        $optionArray = $request->input('options');
        $correctOptions = $request->input('correct');

        $question = new Question();
        $question->topic_id = $topicID;
        $question->question_text = $questionText;
        $question->save();

        $questionToAdd = Question::latest()->first();;
        $questionID = $questionToAdd->id;

        foreach ($optionArray as $index => $opt) {
            $option = new Option();
            $option->question_id = $questionID;
            $option->option = $opt;
            foreach ($correctOptions as $correctOption) {
                if($correctOption == $index+1) {
                    $option->correct = 1;
                }
            }
            $option->save();
        }
    }

    public function update($id, $request)
    {
        $topicID = $request->input('topic_id');
        $questionText = $request->input('question_text');

        $question = Question::find($id);
        $question->topic_id = $topicID;
        $question->question_text = $questionText;
        $question->save();
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
    }
}
