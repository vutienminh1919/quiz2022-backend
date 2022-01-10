<?php

namespace App\Http\Controllers;

use App\Services\QuizQuestionService;
use App\Services\QuizService;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    protected $quizQuestionService;
    protected $quizService;

    public function __construct(QuizQuestionService $quizQuestionService, QuizService $quizService)
    {
        $this->quizService = $quizService;
        $this->quizQuestionService = $quizQuestionService;
    }

    public function store(Request $request)
    {
        $quiz_id = $request->quiz_id;
        $question_id_exist = $this->quizService->findById($quiz_id)->quizQuestion;
        $question_id = $request->question_id;
        for ($i = 0; $i < count($question_id); $i++) {
            for ($j = 0; $j < count($question_id_exist); $j++) {
                if ($question_id[$i] === $question_id_exist[$j]->id){
                    break;
                }
            }
            $data = [
                'quiz_id' => $request->quiz_id,
                'question_id' => $question_id[$i]
            ];
            $this->quizQuestionService->create($data);
        }
    }

    public function destroy($id)
    {
        $this->quizQuestionService->destroy($id);
        return response()->json(['message'=>'Delete completed'], 200);
    }
    public function multiDestroy(Request $request)
    {
        $id = $request->question_id;

        if (empty($id)) {
            return redirect()->back();
        }
        for ($i = 0; $i < count($id); $i++) {
            $this->quizQuestionService->destroy($id[$i]);
        }
        alert()->success('Delete completed', 'Successfully')->autoClose(1600);


        return redirect()->back();
    }
}
