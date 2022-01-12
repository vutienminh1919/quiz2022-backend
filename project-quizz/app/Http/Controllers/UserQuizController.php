<?php

namespace App\Http\Controllers;

use App\Services\QuizQuestionService;
use App\Services\QuizResultService;
use App\Services\QuizService;
use App\Services\UserQuizService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserQuizController extends Controller
{
    protected $quizQuestionService;
    protected $quizService;
    protected $userQuizService;
    protected $quizResultService;

    public function __construct(
        QuizQuestionService $quizQuestionService,
        QuizService $quizService,
        UserQuizService $userQuizService,
        QuizResultService $quizResultService
    )
    {
        $this->quizResultService = $quizResultService;
        $this->userQuizService = $userQuizService;
        $this->quizService = $quizService;
        $this->quizQuestionService = $quizQuestionService;
    }

    public function index($idQuiz)
    {
        $quizQuestion = $this->quizQuestionService->getQuestionsByQuizId($idQuiz);
        //$quiz = $this->quizService->findById($idQuiz);
        return response()->json($quizQuestion);
    }

    public function doQuiz(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $duration = $request->duration;
        $now = time();
        $ten_minutes = $now + ($duration * 60);
        $start_time = date('Y-m-d H:i:s', $now);
        $end_time = date('Y-m-d H:i:s', $ten_minutes);

        $userQuizData = [
            'user_id' => Auth::id(),
            'quiz_id' => $request->quiz_id,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'finished' => 1
        ];
        $userQuiz = $this->userQuizService->create($userQuizData);

        $answer_id = $request->answer_id;
        $question_id[] = $request->question_id;
        $correct = $request->correct;
        $answered = $request->answered;

//        for ($i = 0; $i < count($question_id); $i++) {
//            $quizResultData = [
//                'user_id' => Auth::id(),
//                'quiz_id' => $request->quiz_id,
//                'question_id' => $question_id[$i],
//                'answer_id' => $answer_id[$i],
//                'correct' => $correct[$i],
//                'answered' => $answered[$i],
//                'user_quiz_id' => $userQuiz->id
//            ];
//            $this->quizResultService->create($quizResultData);
//        }
        return response()->json(['quizId' => $userQuiz->id, 'userId' => Auth::id()]);
    }
}
