<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResultRequest;
use App\Models\Question;
use App\Models\Result;
use App\Models\UserResult;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public function index()
    {
        $allResults = Result::orderBy('created_at', 'desc')->get();
        return response()->json($allResults);
    }

    public function store(StoreResultRequest $request)
    {
        //
        $score = 0;
        $questions = $request->input('option');

        if ($questions) {
            foreach ($questions as $key => $value) {
                $question = Question::find($key);
                $userCorrectAnswers = 0;
                foreach ($value as $answerKey => $answerValue) {
                    if ($answerValue == 1) {
                        $userCorrectAnswers++;
                    } else {
                        $userCorrectAnswers--;
                    }
                }
                if ($question->correctOptionsCount() == $userCorrectAnswers) {
                    $score++;
                }
            }
            $result = new Result();
            $result->user_id = Auth::user()->id;
            $result->test_id = $request->input('test_id');
            $result->correct_answers = $score;
            $result->questions_count = count($request->input('question_id'));
            $result->save();

            foreach ($questions as $key => $value) {
                foreach ($value as $answerKey => $answerValue) {
                    $userResult = new UserResult();
                    $result->user_id = Auth::user()->id;
                    $userResult->result_id = $result->id;
                    $userResult->question_id = $key;
                    $userResult->topic_id = $request->input('test_id');
                    $userResult->option_id = $answerKey;
                    $userResult->save();
                }
            }

            return redirect(route('results.show', $result->id));
        } else {
            return redirect()->back();
        }


    }
    public function show($id)
    {

        $result = Result::find($id);

        return response()->json($result);

    }
}
