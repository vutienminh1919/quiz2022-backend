<?php

namespace App\Http\Controllers;

use App\Http\Services\QuizQuestionService;
use App\Services\QuizResultService;
use App\Services\QuizService;
use App\Services\UserQuizService;

class UserQuizController extends Controller
{
    protected $quizService;
    protected $quizQuestionService;
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
        $this->quizService = $quizService;
        $this->quizQuestionService = $quizQuestionService;
        $this->userQuizService = $userQuizService;
    }

    public function index($id)
    {
        $quizQuestions = $this->quizQuestionService->getQuestionsByQuizId($id);
        return response()->json($quizQuestions);
    }
}
