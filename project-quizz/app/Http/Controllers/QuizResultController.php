<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserQuiz;
use App\Services\QuizResultService;
use App\Services\QuizService;
use App\Services\UserQuizService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizResultController extends Controller
{
    protected $quizResultService;
    protected $userQuizService;
    protected $quizService;

    public function __construct(
        QuizResultService $quizResultService,
        UserQuizService $userQuizService,
        QuizService $quizService
    )
    {
        $this->quizResultService = $quizResultService;
        $this->quizService = $quizService;
        $this->userQuizService = $userQuizService;
    }


    public function showResult($id, $userId)
    {
//        dd($userId == Auth::id(),Auth::user()->role !=0);
        if ($userId == Auth::id() || Auth::user()->role != 0) {
            $userQuiz = $this->userQuizService->findById($id);
            $questions = $userQuiz->quizResults->groupBy('question_id');
            $point = 0;
            $checkCorrect = false;
            foreach ($questions as $question) {
                foreach ($question as $item) {
                    if ($item->correct != $item->answered) {
                        $checkCorrect = false;
                        break;
                    } else {
                        $checkCorrect = true;
                    }
                }
                if ($checkCorrect) {
                    $point++;
                }
            };
            $questions_count = $questions->count();

            $userQuiz->point = round($point * 100 / $questions_count,2) ;
            $userQuiz->ratio = $point . '/' . $questions_count;
            $userQuiz->save();
            return response()->json([
                $userQuiz,
                $questions_count,
                $point,
                $questions,
            ]);
        } else {
            abort(403);
        }
    }

    public function showUserResults($userId)
    {
        $user = User::find($userId);
        $userQuizzes = UserQuiz::where('user_id', $user->id)->paginate(10);
        return (Auth::id() == $userId || Auth::user()->role != 0) ?
            response()->json([
                $user,
                $userQuizzes,
            ]) :
            abort(403);
    }

    public function showAllResults($quiz_id)
    {
        $quizResults = $this->quizService->findById($quiz_id)->userQuizzes;
        return response()->json($quizResults);
    }
}
