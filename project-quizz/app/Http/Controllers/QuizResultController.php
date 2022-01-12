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
}
